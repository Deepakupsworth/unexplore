@extends('backend.layout') @section('content') 
<style>
  #file-preview img {
    height: 4rem;
  }
</style>
@php
    use App\Models\Language;

    $languages = Language::all();
    $currentLang = request('lang', 'en'); // default to 'en' if not in URL
@endphp

<div class="content-wrapper transition-all duration-150 ltr:ml-[248px] rtl:mr-[248px]" id="content_wrapper">
  <div class="page-content">
    <div class="transition-all duration-150 container-fluid" id="page_layout">
      <div id="content_layout">
        <!-- BEGIN: Breadcrumb -->
        <div class="mb-5">
          <ul class="m-0 p-0 list-none">
            <li class="inline-block relative top-[3px] text-base text-primary-500 font-Inter ">
              <a href="{{ asset('/') }}">
                <iconify-icon icon="heroicons-outline:home"></iconify-icon>
                <iconify-icon icon="heroicons-outline:chevron-right" class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
              </a>
            </li>
            <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white"> Category</li>
          </ul>
        </div>
        <!-- END: BreadCrumb -->
        <div class="grid xl:grid-cols-1 grid-cols-12 gap-6 px-6">
          <!-- Basic Inputs -->
          <div class="card xl:col-span-2">
            <div class="card-body flex flex-col p-6">
              <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                <div class="flex-1">
                  <div class="card-title text-slate-900 dark:text-white">{{ __('Add category') }}</div>
                </div>
              </header>
             
              <form id="lang-form" action="" method="get">
                
                </form>

              <form class="space-y-4"  action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 gap-7">
                <div class="input-area relative">
               
                <label for="largeInput" class="form-label">Lang</label>
                    <select id="select" class="form-control" onchange="changeLanguage(this)">
                    @foreach($languages as $language)
                    <option  value="{{ $language->code }}" 
                    {{ $currentLang == $language->code ? 'selected' : '' }}>
                    {{ strtoupper($language->code) }}
                    </option>
                    @endforeach
                                </select>
                    </div>
                  <div class="input-area relative">
                    <label for="largeInput" class="form-label">Name</label>
                    <input type="hidden" name="lang" value="{{ request('lang', 'en') }}">
                    <input type="text" name="name" placeholder="Name" class="form-control">
                  </div>
                  <!-- Thumb Image -->
                  <div class="input-area">
                    <label for="imageInput" class="form-label">Thumb Image</label>
                    <label>
                      <input type="file" id="imageInput" name="thumb_image" class="hidden" accept="image/*">
                      <span class="w-full h-[40px] file-control flex items-center custom-class">
                        <span class="flex-1 overflow-hidden text-ellipsis whitespace-nowrap">
                          <span class="text-slate-400">Choose a file or drop it here...</span>
                        </span>
                        <span class="file-name flex-none cursor-pointer border-l px-4 border-slate-200 dark:border-slate-700 h-full inline-flex 
        items-center bg-slate-100 dark:bg-slate-900 text-slate-600 dark:text-slate-400 text-sm 
        rounded-tr rounded-br font-normal">Browse</span>
                      </span>
                    </label>
                    {{-- Preview --}}
                    <div id="previewContainer" class="mt-4 relative hidden w-[100px] h-[100px]">
                      <img id="previewImage" src="#" alt="Preview" class="rounded-lg w-[100px] h-[100px] object-cover border border-slate-200" />
                      <button type="button" id="removeImageBtn" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full 
      w-5 h-5 flex items-center justify-center text-[10px]">✕</button>
                    </div>
                  </div>
                  <!-- Thumb Icon -->
                  <div class="input-area">
                    <label for="imageInput1" class="form-label">Thumb Icon</label>
                    <label>
                      <input type="file" id="imageInput1" name="thumb_icon" class="hidden" accept="image/*">
                      <span class="w-full h-[40px] file-control flex items-center custom-class">
                        <span class="flex-1 overflow-hidden text-ellipsis whitespace-nowrap">
                          <span class="text-slate-400">Choose a file or drop it here...</span>
                        </span>
                        <span class="file-name flex-none cursor-pointer border-l px-4 border-slate-200 dark:border-slate-700 h-full inline-flex 
        items-center bg-slate-100 dark:bg-slate-900 text-slate-600 dark:text-slate-400 text-sm 
        rounded-tr rounded-br font-normal">Browse</span>
                      </span>
                    </label>
                    {{-- Preview --}}
                    <div id="previewContainer1" class="mt-4 relative hidden w-[100px] h-[100px]">
                      <img id="previewImage1" src="#" alt="Preview" class="rounded-lg w-[100px] h-[100px] object-cover border border-slate-200" />
                      <button type="button" id="removeImageBtn1" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full 
      w-5 h-5 flex items-center justify-center text-[10px]">✕</button>
                    </div>
                  </div>
                </div>
                <div class="checkbox-area">
                  <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" class="hidden" name="checkbox">
                    <span class="h-4 w-4 border flex-none border-slate-100 dark:border-slate-800 rounded inline-flex ltr:mr-3 rtl:ml-3 relative
                                        transition-all duration-150 bg-slate-100 dark:bg-slate-900">
                      <img src="assets/images/icon/ck-white.svg" alt="" class="h-[10px] w-[10px] block m-auto opacity-0">
                    </span>
                    <span class="text-slate-500 dark:text-slate-400 text-sm leading-6 pt-3 pb-3">Remember me</span>
                  </label>
                </div>
                <button class="btn inline-flex justify-center btn-dark">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div> 
@endsection 
<script>
function changeLanguage(select) {
    const lang = select.value;
    const baseUrl = "{{ url()->current() }}";  // Example: http://localhost:8000/categories
    const newUrl = `${baseUrl}?lang=${lang}`;
    window.location.href = newUrl;
}
</script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Reusable preview function
    function setupImagePreview(inputId, previewContainerId, previewImageId, removeBtnId) {
      const input = document.getElementById(inputId);
      const container = document.getElementById(previewContainerId);
      const img = document.getElementById(previewImageId);
      const removeBtn = document.getElementById(removeBtnId);
      input.addEventListener("change", function(event) {
        const file = event.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function(e) {
            img.src = e.target.result;
            container.classList.remove("hidden");
          };
          reader.readAsDataURL(file);
        }
      });
      removeBtn.addEventListener("click", function() {
        input.value = "";
        img.src = "#";
        container.classList.add("hidden");
      });
    }
    // Initialize for both inputs
    setupImagePreview("imageInput", "previewContainer", "previewImage", "removeImageBtn");
    setupImagePreview("imageInput1", "previewContainer1", "previewImage1", "removeImageBtn1");
  });
</script>




