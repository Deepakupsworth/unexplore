@props([
    'model' => null,
    'name' => 'gallery',
    'multiple' => true,
    'deleteRoute' => null,
])

<div class="mb-4">
    <label class="form-label mb-2">Gallery</label>

    <input
        type="file"
        name="{{ $name }}[]"
        {{ $multiple ? 'multiple' : '' }}
        class="form-control"
    >
    {{-- @dd($model) --}}
    @if ($model && $model->gallery && $model->gallery->count())
        <div
            class="mt-4
                   grid gap-4
                   grid-cols-2
                   sm:grid-cols-3
                   md:grid-cols-4
                   lg:grid-cols-5"
        >
            @foreach ($model->gallery as $img)


                <div class="relative" id="gallery-img-{{ $img->id }}">

                    {{-- IMAGE WRAPPER --}}
                    <div class="relative overflow-hidden rounded-lg border">
                        <img
                            src="{{ asset('storage/' . $img->image_path) }}"
                            class="w-full h-40 object-cover"
                            alt="Gallery Image"
                        >

                        {{-- ❌ DELETE BUTTON (TOP RIGHT ON IMAGE) --}}
                        @if ($deleteRoute)
                            <button
                                type="button"
                                onclick="deleteGalleryImage('{{ $deleteRoute }}', {{ $img->id }})"
                                class="absolute top-2 right-2
                                       w-7 h-7
                                       flex items-center justify-center
                                       bg-red-500 text-white
                                       rounded-full text-sm
                                       shadow-lg
                                       hover:bg-red-600
                                       transition"
                            >
                                ✕
                            </button>
                        @endif
                    </div>

                </div>
            @endforeach
        </div>
    @endif
</div>

<script>
    function deleteGalleryImage(url, id) {
        if (!confirm('Delete this image?')) return;

        fetch(url.replace(':id', id), {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                document.getElementById('gallery-img-' + id)?.remove();
            }
        });
    }
    </script>
