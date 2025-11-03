@extends('backend.layout')
@section('content')

<style>
  #file-preview img { width: 50px; height: 50px; object-fit: cover; }
  .lang-btn {
    padding: 0.5rem 1rem; /* px-4 py-2 */
    border: 1px solid #cbd5e1; /* border-slate-300 */
    border-radius: 0.375rem; /* rounded-md */
    font-size: 0.875rem; /* text-sm */
    font-weight: 500; /* font-medium */
    cursor: pointer;
    transition: all 0.15s ease-in-out;
  }

  .lang-btn:hover {
    background-color: #f1f5f9; /* hover bg-slate-100 */
  }

  .lang-btn.active {
    background-color: #2563eb; /* bg-primary-600 (Tailwind blue-600) */
    color: #fff;
    border-color: #2563eb;
  }

  .lang-section {
    display: none;
  }

  .lang-section.active {
    display: block;
  }
</style>


<div class="content-wrapper transition-all duration-150 ltr:ml-[248px] rtl:mr-[248px]" id="content_wrapper">
  <div class="page-content">
    <div class="transition-all duration-150 container-fluid" id="page_layout">
      <div id="content_layout">

        <!-- Breadcrumb -->
        <div class="mb-5">
          <ul class="m-0 p-0 list-none">
            <li class="inline-block text-base text-primary-500">
              <a href="{{ route('cities.index') }}">
                <iconify-icon icon="heroicons-outline:home"></iconify-icon>
                <iconify-icon icon="heroicons-outline:chevron-right" class="text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
              </a>
            </li>
            <li class="inline-block text-sm text-slate-500">
              {{ $model->id ? 'Edit City' : 'Add Category' }}
            </li>
          </ul>
        </div>

        <div class="grid xl:grid-cols-1 grid-cols-12 gap-6 px-6">
          <div class="card xl:col-span-2">
            <div class="card-body flex flex-col p-6">
              <header class="flex mb-5 items-center border-b pb-5">
                <div class="flex-1">
                  <div class="card-title text-slate-900 dark:text-white">
                    {{ $model->id ? 'Edit City' : 'Add Category' }}
                  </div>
                </div>
              </header>

              <form action="{{ route('categories.save') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="id" value="{{ $model->id }}">

                <div class="input-area">
                  {{-- LANGUAGE BUTTONS --}}
                  <div class="mt-6">
                    <div class="flex gap-2 mb-4">
                      @foreach($languages as $lang)
                        <button type="button"
                                class="lang-btn {{ $loop->first ? 'active' : '' }}"
                                data-lang="{{ $lang->code }}">
                          {{ strtoupper($lang->name) }}
                        </button>
                      @endforeach
                    </div>

                    {{-- LANGUAGE SECTIONS --}}
                    @foreach($languages as $lang)
                      @php
                        $trans = $model->translations->where('language_id', $lang->id)->first() ?? null;
                      @endphp
                      <div class="lang-section {{ $loop->first ? 'active' : '' }}" id="lang-section-{{ $lang->code }}">

                        {{-- Name --}}
                        <div class="input-area">
                          <label class="form-label">
                            Name ({{ strtoupper($lang->code) }})
                            @if($lang->code === 'en') <span class="text-red-500">*</span> @endif
                          </label>
                          <input type="text"
                                name="translations[{{ $lang->id }}][name]"
                                class="form-control"
                                value="{{ old("translations.$lang->id.name", $trans->name ?? '') }}"
                                @if($lang->code === 'en') required @endif>
                          @error("translations.$lang->id.name")
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                          @enderror
                        </div>

                       
                      </div>
                    @endforeach
                  </div>
                </div>

                {{-- Slug --}}
                <div class="input-area">
                  <label class="form-label">Slug <span class="text-red-500">*</span></label>
                  <input type="text" name="slug" class="form-control" value="{{ old('slug', $model->slug) }}" required>
                  @error('slug')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                  @enderror
                </div>
                <header class="flex mb-5 items-center pb-5 pt-5">
                <div class="flex-1">
                  <div class="card-title text-slate-900 dark:text-white">
                   Media
                  </div>
                </div>
              </header>

               

                <!-- {{-- Thumb Image --}}
                <div class="input-area relative">
                  <label class="form-label">Thumb Image</label>
                  <input type="file" id="imageInput" name="thumb_image" class="form-control" accept="image/*">
                  @error('thumb_image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                  @enderror

                  <div id="previewContainer" class="mt-4 relative pb-10 {{ $model->thumb_image ? '' : 'hidden' }}">
                    <img id="previewImage"
                         src="{{ $model->thumb_image ? asset('storage/'.$model->thumb_image) : '#' }}"
                         alt="Preview"
                         class="rounded border border-slate-200"
                         style="width: 50px; height: 50px;">

                         <button type="button" id="removeImageBtn"
                                class="absolute top-0 left-0 m-1 bg-red-500 text-white rounded-full text-xs px-1 py-0.5 items-center justify-center"
                                >
                            ✕
                        </button>
                 
                  </div>
                </div>

                {{-- Thumb icon --}}
                <div class="input-area mt-4">
                    <label class="form-label">Thumb Icon</label>
                    <input 
                        type="file" 
                        id="galleryInput" 
                        name="thumb_icon" 
                        class="form-control" 
                        accept="image/*" 
                        multiple
                    >
                    @error('thumb_icon')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                  @enderror
                  <div id="previewContainer" class="mt-4 relative pb-10 {{ $model->thumb_icon ? '' : 'hidden' }}">
                    <img id="previewImage"
                         src="{{ $model->thumb_icon ? asset('storage/'.$model->thumb_icon) : '#' }}"
                         alt="Preview"
                         class="rounded border border-slate-200"
                         style="width: 50px; height: 50px;">

                         <button type="button" id="removeImageBtn"
                                class="absolute top-0 left-0 m-1 bg-red-500 text-white rounded-full text-xs px-1 py-0.5 items-center justify-center"
                                >
                            ✕
                        </button>
                 
                  </div>

                   
                </div> -->
                {{-- Thumb Image --}}
<div class="input-area relative">
  <label class="form-label">Thumb Image</label>
  <input type="file" id="thumbImageInput" name="thumb_image" class="form-control" accept="image/*">
  @error('thumb_image')
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
  @enderror

  <div id="thumbImagePreview" class="mt-4 relative pb-10 {{ $model->thumb_image ? '' : 'hidden' }}">
    <img
      src="{{ $model->thumb_image ? asset('storage/'.$model->thumb_image) : '#' }}"
      alt="Thumb Preview"
      class="rounded border border-slate-200 object-cover"
      style="width: 50px; height: 50px;"
    >
    <button
      type="button"
      data-type="thumb_image"
      data-id="{{ $model->id ?? '' }}"
      class="absolute top-0 left-0 m-1 bg-red-500 text-white rounded-full text-xs px-1 py-0.5 items-center justify-center remove-existing"
    >
      ✕
    </button>
  </div>
</div>

{{-- Thumb Icon --}}
<div class="input-area mt-4">
  <label class="form-label">Thumb Icon</label>
  <input
    type="file"
    id="thumbIconInput"
    name="thumb_icon"
    class="form-control"
    accept="image/*"
  >
  @error('thumb_icon')
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
  @enderror

  <div id="thumbIconPreview" class="mt-4 relative pb-10 {{ $model->thumb_icon ? '' : 'hidden' }}">
    <img
      src="{{ $model->thumb_icon ? asset('storage/'.$model->thumb_icon) : '#' }}"
      alt="Icon Preview"
      class="rounded border border-slate-200 object-cover"
      style="width: 50px; height: 50px;"
    >
    <button
      type="button"
      data-type="thumb_icon"
      data-id="{{ $model->id ?? '' }}"
      class="absolute top-0 left-0 m-1 bg-red-500 text-white rounded-full text-xs px-1 py-0.5 items-center justify-center remove-existing"
    >
      ✕
    </button>
  </div>
</div>

              

                <button type="submit" class="btn inline-flex justify-center btn-dark mt-5">
                  {{ $model->id ? 'Update' : 'Create' }}
                </button>

              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function () {

  // ============================================================
  // 🖼️ SINGLE IMAGE PREVIEW (Thumb Image + Thumb Icon)
  // ============================================================

  function setupImagePreview(inputId, previewId, deleteUrl) {
    const input = document.getElementById(inputId);
    const previewContainer = document.getElementById(previewId);
    const previewImg = previewContainer.querySelector('img');

    if (!input || !previewContainer) return;

    // Live Preview on New File Select
    input.addEventListener("change", function (event) {
      const file = event.target.files[0];
      if (!file) return;

      const reader = new FileReader();
      reader.onload = (e) => {
        previewImg.src = e.target.result;
        previewContainer.classList.remove("hidden");
      };
      reader.readAsDataURL(file);
    });
  }

  // Apply to both fields
  setupImagePreview("thumbImageInput", "thumbImagePreview", "/admin/cities/thumb-image/delete");
  setupImagePreview("thumbIconInput", "thumbIconPreview", "/admin/cities/thumb-icon/delete");


  // ============================================================
  // 🗑️ DELETE EXISTING IMAGE (AJAX)
  // ============================================================

  document.querySelectorAll(".remove-existing").forEach((btn) => {
    btn.addEventListener("click", function () {
      const type = this.dataset.type; // thumb_image or thumb_icon
      const id = this.dataset.id;
      const container = this.closest("div[id$='Preview']"); // dynamic select (thumbImagePreview or thumbIconPreview)

      if (!id) {
        // If new upload (not saved yet)
        const input = document.querySelector(`input[name='${type}']`);
        input.value = "";
        container.classList.add("hidden");
        container.querySelector("img").src = "#";
        return;
      }

      if (confirm("Are you sure you want to delete this image?")) {
        fetch(`/admin/cities/${type}/delete/${id}`, {
          method: "DELETE",
          headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Accept": "application/json",
          },
        })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            container.classList.add("hidden");
            container.querySelector("img").src = "#";
            const input = document.querySelector(`input[name='${type}']`);
            input.value = "";
          } else {
            alert("Failed to delete image.");
          }
        })
        .catch(() => alert("Something went wrong."));
      }
    });
  });

    // Language button toggle
    const langButtons = document.querySelectorAll('.lang-btn');
  const langSections = document.querySelectorAll('.lang-section');

  langButtons.forEach(button => {
    button.addEventListener('click', () => {
      const targetLang = button.dataset.lang;

      // Toggle active button
      langButtons.forEach(btn => btn.classList.remove('active'));
      button.classList.add('active');

      // Toggle active language section
      langSections.forEach(section => {
        section.classList.remove('active');
        if (section.id === 'lang-section-' + targetLang) {
          section.classList.add('active');
        }
      });
    });
  });

});
</script>

<!-- <script>
document.addEventListener("DOMContentLoaded", function () {

  // ============================================================
  // 🖼️ SINGLE THUMBNAIL IMAGE PREVIEW
  // ============================================================
  const thumbInput = document.querySelector('input[name="thumb_image"], input[name="thumb_icon"]');
  if (thumbInput) {
    const existingPreview = document.createElement('div');
    existingPreview.id = 'thumbPreview, iconPreview';
    existingPreview.className = 'mt-3';
    thumbInput.insertAdjacentElement('afterend', existingPreview);

    thumbInput.addEventListener('change', function (event) {
      const file = event.target.files[0];
      if (!file) return;

      const reader = new FileReader();
      reader.onload = e => {
        existingPreview.innerHTML = `
          <div class="relative w-14 h-14 border rounded overflow-hidden">
            <img src="${e.target.result}" class="w-14 h-14 object-cover rounded">
            <button type="button" class="absolute m-1 top-0 left-0 bg-red-500 text-white text-xs px-1 py-0.5 rounded remove-thumb">✕</button>
          </div>
        `;
      };
      reader.readAsDataURL(file);
    });

    // Remove thumb before upload
    existingPreview.addEventListener('click', function (e) {
      if (e.target.classList.contains('remove-thumb')) {
        thumbInput.value = "";
        existingPreview.innerHTML = "";
      }
    });
  }

  // ============================================================
  // 🖼️ MULTIPLE GALLERY IMAGE PREVIEW (BEFORE UPLOAD)
  // ============================================================
  const galleryInput = document.getElementById('galleryInput');
  const galleryPreview = document.getElementById('galleryPreview');
  let selectedFiles = [];

  if (galleryInput) {
    galleryInput.addEventListener('change', function (event) {
      const newFiles = Array.from(event.target.files);
      selectedFiles = selectedFiles.concat(newFiles);
      renderPreviews();
    });

    function renderPreviews() {
      galleryPreview.innerHTML = '';
      selectedFiles.forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = function (e) {
          const wrapper = document.createElement('div');
          wrapper.className = 'relative w-14 h-14 border rounded overflow-hidden';
          wrapper.innerHTML = `
            <img src="${e.target.result}" class="w-14 h-14 object-cover rounded">
            <button type="button" data-index="${index}" 
                    class="absolute top-0 m-1 left-0 bg-red-500 text-white text-xs px-1 py-0.5 rounded remove-preview">✕</button>
          `;
          galleryPreview.appendChild(wrapper);
        };
        reader.readAsDataURL(file);
      });
      updateInputFiles();
    }

    function updateInputFiles() {
      const dataTransfer = new DataTransfer();
      selectedFiles.forEach(file => dataTransfer.items.add(file));
      galleryInput.files = dataTransfer.files;
    }

    galleryPreview.addEventListener('click', function (e) {
      if (e.target.classList.contains('remove-preview')) {
        const index = parseInt(e.target.dataset.index);
        selectedFiles.splice(index, 1);
        renderPreviews();
      }
    });
  }

  // ============================================================
  // 🗑️ DELETE EXISTING GALLERY IMAGE (AJAX)
  // ============================================================
  document.querySelectorAll('.delete-image').forEach(btn => {
    btn.addEventListener('click', function () {
      if (confirm('Are you sure you want to delete this image?')) {
        fetch(`/admin/cities/gallery/delete/${this.dataset.id}`, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
          }
        })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            this.closest('div.relative').remove();
          } else {
            alert('Failed to delete image');
          }
        })
        .catch(() => alert('Something went wrong'));
      }
    });
  });



    // Language button toggle
const langButtons = document.querySelectorAll('.lang-btn');
  const langSections = document.querySelectorAll('.lang-section');

  langButtons.forEach(button => {
    button.addEventListener('click', () => {
      const targetLang = button.dataset.lang;

      // Toggle active button
      langButtons.forEach(btn => btn.classList.remove('active'));
      button.classList.add('active');

      // Toggle active language section
      langSections.forEach(section => {
        section.classList.remove('active');
        if (section.id === 'lang-section-' + targetLang) {
          section.classList.add('active');
        }
      });
    });
  });
  
});
</script> -->

@endsection

{{-- SCRIPTS --}}
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>




