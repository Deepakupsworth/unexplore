<div class="container">
    <div class="gallery-wrapper swiper">
        <div class="swiper-wrapper  gallery-grid">
            <!-- LEFT LARGE IMAGE -->
            <div class="gallery-item gallery-item--large swiper-slide open-gallery"
                data-open-tab="galleryTabsDestination" data-bs-toggle="modal" data-bs-target="#galleryModal">
                {{-- <img class="img-fluid" src="{{ asset('frontend/assets/package-banner.png') }}" alt=""> --}}
                <img class="img-fluid"
                    src="{{ $package->thumb?->image_path
                        ? asset('storage/' . $package->thumb->image_path)
                        : asset('frontend/assets/package-details-banner.png') }}"
                    alt="">
                <button class="view-gallery-btn stretched-link" data-bs-toggle="modal"
                    data-bs-target="#galleryModal" data-open-tab="galleryTabsDestination">
                    <i class="fa-regular fa-image"></i>
                    {{ __('package.gallery.view') }} →
                </button>
            </div>

            <!-- RIGHT GRID -->
            <div class="gallery-middle swiper-slide">
                <div class="d-flex flex-column gap-2" data-open-tab="galleryTabsDestination"
                data-bs-toggle="modal" data-bs-target="#galleryModal">


                    @php
                        $gallery_image1 = data_get($package, 'gallery.0.image_path')
                            ? asset('storage/' . data_get($package, 'gallery.0.image_path'))
                            : asset('frontend/assets/package-banner.png');

                        $gallery_image2 = data_get($package, 'gallery.1.image_path')
                            ? asset('storage/' . data_get($package, 'gallery.1.image_path'))
                            : asset('frontend/assets/package-banner.png');
                    @endphp


                    <div class="gallery-item half">

                        <img class="img-fluid" src="{{ $gallery_image1 ?? '' }}" alt="">
                    </div>

                    <div class="gallery-item  half open-gallery" >
                        <img class="img-fluid" src="{{ $gallery_image2 ?? '' }}" alt="">
                        <p class="p-small">{{ __('gallery.gallery') }}</p>
                    </div>

                </div>

                <div class="d-flex flex-column gap-2" >
                    <div class="gallery-item half open-gallery"  @if(!empty(@$finalArray['todo'][0]['thumb'])) data-open-tab="galleryTabsProperty" @elseif($finalArray['event'][0]['thumb']) data-open-tab="galleryTabsActivities"  @else data-open-tab="galleryTabsHighlights" @endif  data-bs-toggle="modal"
                    data-bs-target="#galleryModal">
                        <?php

                        $imagePathToDo = match (true) {
                            !empty($finalArray['todo'][0]['thumb']) => asset('storage/' . $finalArray['todo'][0]['thumb']->image_path),

                            !empty($finalArray['event'][1]['thumb']) => asset('storage/' . $finalArray['event'][1]['thumb']->image_path),

                            !empty($finalArray['event'][0]['thumb']) => asset('storage/' . $finalArray['event'][0]['thumb']->image_path),

                            !empty($finalArray['hotel'][1]['thumb']) => asset('storage/' . $finalArray['hotel'][1]['thumb']->image_path),

                            !empty($finalArray['hotel'][0]['thumb']) => asset('storage/' . $finalArray['hotel'][0]['thumb']->image_path),

                            !empty($package->thumb) => asset('storage/' . $package->thumb->image_path),

                            default => asset('frontend/assets/package-banner.png'),
                        };
                        ?>
                        <img class="img-fluid" src="{{ $imagePathToDo }}" alt="">
                        <p class="p-small">
                        @if(!empty(@$finalArray['todo'][0]['thumb']))
                        {{ __('package.gallery.activities') }}
                        @else
                        {{ __('checkout.events') }}
                        @endif
                        </p>


                    </div>

                    <div class="gallery-item  half open-gallery" @if(!empty(@$finalArray['event'][0]['thumb'])) data-open-tab="galleryTabsActivities" @elseif($finalArray['todo'][0]['thumb']) data-open-tab="galleryTabsProperty" @else data-open-tab="galleryTabsHighlights" @endif data-bs-toggle="modal"
                    data-bs-target="#galleryModal">
                        @php
                            $imagePathEvent = match (true) {
                                !empty($finalArray['event'][0]['thumb']) => asset(
                                    'storage/' . $finalArray['event'][0]['thumb']->image_path,
                                ),

                                !empty($finalArray['todo'][1]['thumb']) => asset(
                                    'storage/' . $finalArray['todo'][1]['thumb']->image_path,
                                ),

                                !empty($finalArray['todo'][0]['thumb']) => asset(
                                    'storage/' . $finalArray['todo'][0]['thumb']->image_path,
                                ),

                                !empty($finalArray['hotel'][1]['thumb']) => asset(
                                    'storage/' . $finalArray['hotel'][1]['thumb']->image_path,
                                ),

                                !empty($finalArray['hotel'][0]['thumb']) => asset(
                                    'storage/' . $finalArray['hotel'][0]['thumb']->image_path,
                                ),

                                !empty($package->thumb) => asset('storage/' . $package->thumb->image_path),

                                default => asset('frontend/assets/package-banner.png'),
                            };

                        @endphp
                        <img class="img-fluid" src="{{ $imagePathEvent }}" alt="">
                        <p class="p-small">
                        @if(!empty(@$finalArray['event'][0]['thumb']))
                        {{ __('checkout.events') }}
                        @else
                        {{ __('package.gallery.activities') }}
                        @endif
                    </p>
                    </div>


                </div>
            </div>

            <div class="gallery-item gallery-item--large swiper-slide open-gallery"
                data-open-tab="galleryTabsHighlights" data-bs-toggle="modal" data-bs-target="#galleryModal">
                @php
                    $imagePathHotel = match (true) {
                        !empty($finalArray['hotel'][0]['thumb']) => asset(
                            'storage/' . $finalArray['hotel'][0]['thumb']->image_path,
                        ),

                        !empty($finalArray['event'][0]['thumb']) => asset(
                            'storage/' . $finalArray['event'][0]['thumb']->image_path,
                        ),

                        !empty($finalArray['todo'][0]['thumb']) => asset(
                            'storage/' . $finalArray['todo'][0]['thumb']->image_path,
                        ),

                        !empty($package->thumb) => asset('storage/' . $package->thumb->image_path),

                        default => asset('frontend/assets/package-banner.png'),
                    };
                @endphp



                <img class="img-fluid" src="{{ $imagePathHotel }}" alt="">
                <p class="p-small">{{ __('checkout.hotels') }}</p>
            </div>
        </div>
    </div>
</div>