<div class="tab-pane fade" id="explore-saudi__additional-tab-content" role="tabpanel"
    aria-labelledby="pkg-details__additional-tab">
    <div class="pkg-details__content-wrapper mt-4">
        <p class="p-large fw-bold">{{ __('package.tabs.additional_info') }}</p>
        <div class="pkg-details__additional-info mt-3">
            @foreach ($package->infos as $info)
                <div class="pkg-details__additional-info-item">
                    <p class="fw-bold pkg-details__additional-info-item-header">
                        {{ $info->translation->title }}</p>
                    {{-- <ul class="pkg-details__additional-info-item-list m-0">
                    <li>The deal is valid for travel till 30th September 2025.</li>
                </ul> --}}
                    {!! $info->translation->content !!}

                </div>
            @endforeach
        </div>
    </div>
</div>
