@props(['thing'])

<div class="dis-adventure__carousel-item swiper-slide">
    <img src="{{ asset('storage/' . $thing->thumb->image_path) }}" alt="Adventure Image 1" class="img-fluid">
    <div class="dis-adventure__carousel-item-content">
        <div class="dis-adventure__carousel-item-top">
            {{-- <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Macca</div> --}}
        </div>
        <div class="dis-adventure__carousel-item-bottom">
            <h6>{{ $thing->translation->name }}</h6>
            <div class="dis-adventure__carousel-item-footer">
                {{-- <p class="dis-adventure__carousel-riyal"><img src="../assets/icons/riyal.svg" alt="Riyal"> 1500</p> --}}
                <a href="{{ route('packages.index') }}"
                    class="btn btn-outline-light rounded-pill">
                    Related packages ( {{ $thing->package_count }})
                </a>
            </div>
        </div>
    </div>
</div>
