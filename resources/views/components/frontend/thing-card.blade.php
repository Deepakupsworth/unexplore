@props(['thing'])

<div class="dis-adventure__carousel-item swiper-slide">
    <img src="{{ asset('storage/' . $thing->thumb->image_path) }}" alt="Adventure Image 1" class="img-fluid">
    <div class="dis-adventure__carousel-item-content">
        <div class="dis-adventure__carousel-item-top">
            <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> {{$thing?->city?->translationData?->name}}</div>
        </div>
        <div class="dis-adventure__carousel-item-bottom">
            <a href="{{ route('things-to-do.show', $thing->slug) }}" class="text-white text-decoration-none">
                <h6>{{ $thing->translation->name }}</h6>
            </a>
            <div class="dis-adventure__carousel-item-footer">
                {{-- <p class="dis-adventure__carousel-riyal"><img src="../assets/icons/riyal.svg" alt="Riyal"> 1500</p> --}}
                @if ($thing->package_count > 0)
                    <a href="{{ route('packages.index', [
                        'todo_id' => $thing->id,
                    ]) }}"
                        class="btn btn-outline-light rounded-pill">
                        Related packages ({{ $thing->package_count }})
                    </a>
                @endif

            </div>
        </div>
    </div>
</div>
