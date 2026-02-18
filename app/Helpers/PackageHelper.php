<?php

if (! function_exists('packageListingUl')) {

    function packageListingUl($days, $rating = null)
    {
        if ($days->isEmpty()) {
            return '';
        }

        $items = $days->flatMap(fn($day) => $day->items);

        // Transport types
        $transportTypes = $items
            ->where('item_type', 'transport')
            ->pluck('transport.type')
            ->filter()
            ->unique();


        if (!empty($rating)) {
            $hotelItem = $items
                ->where('item_type', 'hotel')
                ->first(function ($item) use ($rating) {

                    // ✅ agar rating filter nahi hai → first hotel le lo
                    if (empty($rating)) {
                        return true;
                    }

                    // ✅ rating filter apply
                    return in_array(
                        optional($item->hotel)->star_rating,
                        (array) $rating
                    );
                });

            $hotelRating = optional($hotelItem?->hotel)->star_rating;
        } else {


            $hotelRating = optional(
                $items->firstWhere('item_type', 'hotel')?->hotel
            )->star_rating;
        }


        // Counts
        $eventCount = $items->where('item_type', 'event')->count();
        $todoCount  = $items->where('item_type', 'todo')->count();

        // Build HTML
        $html = '<ul class="exclusive-offers__carousel-features-list">';

        if ($transportTypes->contains('flight')) {
            $html .= '<li><span>Round Trip Flights</span></li>';
        }

        if ($hotelRating) {
            $html .= '<li><span>' . $hotelRating . ' Star Hotels</span></li>';
        }

        if ($transportTypes->contains('taxi')) {
            $html .= '<li><span>Airport Transfers</span></li>';
        }

        if ($transportTypes->contains('bus')) {
            $html .= '<li><span>Bus Transfers</span></li>';
        }

        if ($eventCount) {
            $html .= '<li><span>' . $eventCount . ' Activities</span></li>';
        }

        // if ($todoCount) {
        //     $html .= '<li><span>Selected Meals</span></li>';
        // }

        $html .= '</ul>';

        return $html;
    }
}
