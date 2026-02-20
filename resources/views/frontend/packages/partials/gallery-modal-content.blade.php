 <!-- VIEW GALLERY MODAL -->
 <div class="modal fade" id="galleryModal" tabindex="-1">
     <div class="modal-dialog modal-fullscreen">
         <div class="modal-content gallery-modal">
             <div class="container">
                 <!-- HEADER -->
                 <div class="modal-header border-0 px-0 pt-5 pb-0">
                     <h4 class="fw-bold mb-0">{{ $t->title }}</h4>
                     <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                 </div>

                 <div class="gallery-sticky-header pt-4">
                     <!-- CATEGORY TABS -->
                     <ul class="nav nav-tabs gallery-tabs" id="galleryTabs" role="tablist">
                         <li class="nav-item" role="presentation">
                             <button class="nav-link active" data-target="galleryTabsDestination" type="button"
                                 role="tab">
                                 {{ $t->title }} {{ __('gallery.package') }}
                                 <!-- <small class="d-block text-light2 fw-normal">9 Photos</small> -->
                             </button>
                         </li>

                         @if (!empty($finalArray['todo']))
                             <li class="nav-item" role="presentation">
                                 <button class="nav-link" data-target="galleryTabsProperty" type="button"
                                     role="tab">
                                     {{ __('gallery.activities_sightseeing') }}
                                     <!-- <small class="d-block text-light2 fw-normal">170 Photos</small> -->
                                 </button>
                             </li>
                         @endif

                         @if (!empty($finalArray['event']))
                             <li class="nav-item" role="presentation">
                                 <button class="nav-link" data-target="galleryTabsActivities" type="button"
                                     role="tab">
                                     {{ __('gallery.events') }}
                                     <!-- <small class="d-block text-light2 fw-normal">20 Photos</small> -->
                                 </button>
                             </li>
                         @endif

                         @if (!empty($finalArray['hotel']))
                             <li class="nav-item" role="presentation">
                                 <button class="nav-link" data-target="galleryTabsHighlights" type="button"
                                     role="tab">
                                     {{ __('gallery.hotels') }}
                                     <!-- <small class="d-block text-light2 fw-normal">3 Photos</small> -->
                                 </button>
                             </li>
                         @endif
                     </ul>

                     <hr class="my-3">

                     <!-- FILTER PILLS -->
                     <!-- PILLS FOR TAB 1 -->
                     <div class="gallery-section-pills" data-tab="galleryTabsDestination">

                         <button class="filter-pill" data-section="port-blair">{{ __('gallery.package_image') }}</button>
                         <button class="filter-pill" data-section="havelock">{{ __('gallery.package_gallery') }}</button>

                     </div>

                     <?php
                     $galleryTabs = [];
                     $galleryTabs['todo'] = 'galleryTabsProperty';
                     $galleryTabs['event'] = 'galleryTabsActivities';
                     $galleryTabs['hotel'] = 'galleryTabsHighlights';

                     ?>

                     @foreach ($finalArray as $key => $value)
                         @if ($key != 'package' && $key != 'transport')
                             <!-- PILLS FOR TAB 2 -->
                             <div class="gallery-section-pills d-none" data-tab="{{ $galleryTabs[$key] }}">
                                 @foreach ($value as $typeData)
                                     <button class="filter-pill active"
                                         data-section="{{ $typeData['name'] }}">{{ $typeData['name'] }}</button>
                                 @endforeach
                             </div>
                         @endif
                     @endforeach

                     <hr class="my-3">
                 </div>

                 <!-- CONTENT -->
                 <div class="modal-body px-0 pt-0 gallery-tab-content-wrapper">
                     <div class="gallery-tab-content active" id="galleryTabsDestination">
                         <!-- VIDEO SECTION -->
                         <!-- <div class="gallery-modal-section" data-section="video">

                                    <h5 class="fw-bold">Around the Destination</h5>
                                    <p class="text-muted small mt-1 mb-3">Video</p>

                                    <div class="gallery-video mb-4">
                                        <video controls>
                                            <source src="../assets/videos/seekers-entry-video.mp4" type="video/mp4">
                                        </video>
                                    </div>
                                </div> -->

                         <div class="gallery-modal-section mb-2" data-section="port-blair">
                             <!-- IMAGE GRID PLACEHOLDER -->
                             <h5 class="fw-bold mb-2">{{ __('gallery.image') }}</h5>
                             <!-- <p class="text-muted small mt-1 mb-3">Port Blair</p> -->

                             <div class="gallery-image-grid">
                                 <div class="gallery-img-box">
                                    <img class="img-fluid"
                                    src="{{ $package->thumb?->image_path
                                       ? asset('storage/' . $package->thumb->image_path)
                                       : asset('frontend/assets/package-details-banner.png') }}"
                                    alt="">
                                 </div>

                             </div>
                         </div>

                         <div class="gallery-modal-section" data-section="havelock">
                             <!-- IMAGE GRID PLACEHOLDER -->
                             <h5 class="fw-bold">{{ $t->title }}</h5>
                             <p class="text-muted small mt-1 mb-3">{{ __('gallery.gallery') }}</p>

                             <div class="three-gallery-image">
                                 @foreach ($package->gallery as $pgallery)
                                     <div class="gallery-img-box">
                                         <img class="img-fluid" src="{{ asset('storage/' . $pgallery->image_path) }}"
                                             alt="">
                                     </div>
                                 @endforeach

                             </div>
                         </div>


                     </div>

                     <div class="gallery-tab-content" id="galleryTabsProperty">

                         @if (!empty($finalArray['todo']))

                             @foreach ($finalArray['todo'] as $typeData)
                                 <div class="gallery-modal-section" data-section="{{ $typeData['name'] }}">
                                     <!-- VIDEO SECTION -->
                                     <h5 class="fw-bold">{{ $typeData['name'] }}</h5>
                                     <p class="text-muted small mt-1 mb-3">{{ __('gallery.image') }}</p>

                                     <div class="gallery-image-grid mb-2">
                                        @if(isset($typeData['thumb']) && isset($typeData['thumb']->image_path))
                                         <div class="gallery-img-box">
                                             <img class="img-fluid"
                                                 src="{{ asset('storage/' . $typeData['thumb']->image_path) }}"
                                                 alt="">
                                         </div>
                                        @endif
                                     </div>

                                     <p class="text-muted small mt-1 mb-2">{{ __('gallery.gallery') }}</p>
                                     <div class="gallery-image-grid">
                                         @foreach ($typeData['gallery'] as $todoGallery)
                                             <div class="gallery-img-box">
                                                 <img class="img-fluid"
                                                     src="{{ asset('storage/' . $todoGallery->image_path) }}"
                                                     alt="">
                                             </div>
                                         @endforeach
                                     </div>
                                 </div>
                             @endforeach
                         @endif



                     </div>

                     <div class="gallery-tab-content" id="galleryTabsActivities">
                         @if (!empty($finalArray['event']))

                             @foreach ($finalArray['event'] as $typeData)
                                 <div class="gallery-modal-section" data-section="{{ $typeData['name'] }}">
                                     <!-- VIDEO SECTION -->
                                     <h5 class="fw-bold">{{ $typeData['name'] }}</h5>
                                     <p class="text-muted small mt-1 mb-3">{{ __('gallery.image') }}</p>

                                     <div class="gallery-image-grid">
                                         @if (isset($typeData['thumb']) && isset($typeData['thumb']->image_path))
                                             <div class="gallery-img-box">
                                                 <img class="img-fluid"
                                                     src="{{ asset('storage/' . $typeData['thumb']->image_path) }}"
                                                     alt="">
                                             </div>
                                         @endif
                                     </div>

                                     <p class="text-muted small mt-1 mb-3">{{ __('gallery.gallery') }}</p>
                                     <div class="gallery-image-grid">
                                         @foreach ($typeData['gallery'] as $eventGallery)
                                             <div class="gallery-img-box">
                                                 <img class="img-fluid"
                                                     src="{{ asset('storage/' . $eventGallery->image_path) }}"
                                                     alt="">
                                             </div>
                                         @endforeach
                                     </div>
                                 </div>
                             @endforeach
                         @endif
                     </div>

                     <div class="gallery-tab-content" id="galleryTabsHighlights">
                         @if (!empty($finalArray['hotel']))

                             @foreach ($finalArray['hotel'] as $typeData)
                                 <div class="gallery-modal-section" data-section="{{ $typeData['name'] }}">
                                     <!-- VIDEO SECTION -->
                                     <h5 class="fw-bold">{{ $typeData['name'] }}</h5>
                                     <p class="text-muted small mt-1 mb-3">{{ __('gallery.image') }}</p>
                                     @if (isset($typeData['thumb']) && isset($typeData['thumb']->image_path))
                                         <div class="gallery-image-grid">
                                             <div class="gallery-img-box">
                                                 <img class="img-fluid"
                                                     src="{{ asset('storage/' . $typeData['thumb']->image_path) }}"
                                                     alt="">
                                             </div>

                                         </div>
                                     @endif

                                     <p class="text-muted small mt-1 mb-3">{{ __('gallery.gallery') }}</p>
                                     <div class="gallery-image-grid">
                                         @foreach ($typeData['gallery'] as $hotelGallery)
                                             @if (isset($typeData['gallery']) && isset($hotelGallery->image_path))
                                                 <div class="gallery-img-box">
                                                     <img class="img-fluid"
                                                         src="{{ asset('storage/' . $hotelGallery->image_path) }}"
                                                         alt="">
                                                 </div>
                                             @endif
                                         @endforeach
                                     </div>
                                 </div>
                             @endforeach
                         @endif


                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
