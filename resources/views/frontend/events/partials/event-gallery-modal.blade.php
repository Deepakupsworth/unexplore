<div class="modal fade gallery-modal" id="eventGalleryModal" tabindex="-1" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-transparent border-0">

            <!-- Close Button -->
            <button type="button" class="btn-close gallery-close" data-bs-dismiss="modal"></button>

            <div class="pkg-details__banner gallery-modal-parent-carousel-wrapper swiper m-0 p-0">
                <div class="swiper-wrapper">
                    @foreach ($currentEvent->gallery as $img)
                        <div class="swiper-slide">
                            <img src="{{ asset('storage/' . $img->image_path) }}" alt="Gallery Image"
                                class="img-fluid w-100">
                        </div>
                    @endforeach
                </div>
                <div class="gallery-swiper-pagination"></div>
            </div>
            <div class="position-relative mt-4 gallery-modal-carousel-container">
                <div class="gallery-modal-carousel-wrapper swiper">
                    <div class="swiper-wrapper gap-2">
                        @foreach ($currentEvent->gallery as $img)
                            <div class="pkg-details__banner-carousel-item swiper-slide">
                                <img src="{{ asset('storage/' . $img->image_path) }}" alt="Gallery Image"
                                    class="img-fluid w-100">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="swiper-button-next gallery-carousel__next">
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
                <div class="swiper-button-prev gallery-carousel__prev">
                    <i class="fa-solid fa-arrow-left"></i>
                </div>
            </div>

            <!-- Main Image -->
            <!-- <div class="gallery-main">
                  <img id="galleryMainImg" src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=1200"
                    class="img-fluid">
                </div> -->

            <!-- Thumbnails + Arrows -->
            <!-- <div class="gallery-thumbs-wrapper">

                  <button class="gallery-arrow" id="prevImg">&#10094;</button>

                  <div class="gallery-thumbs">
                    <img class="thumb active" src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=300">
                    <img class="thumb" src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=300">
                    <img class="thumb" src="https://images.unsplash.com/photo-1519681393784-d120267933ba?w=300">
                    <img class="thumb" src="https://images.unsplash.com/photo-1491553895911-0055eca6402d?w=300">
                    <img class="thumb" src="https://images.unsplash.com/photo-1491553895911-0055eca6402d?w=300">
                  </div>

                  <button class="gallery-arrow" id="nextImg">&#10095;</button>
                </div> -->

        </div>
    </div>
</div>
