@extends('backend.layout') @section('content') 
<style>
  #file-preview img {
    height: 4rem;
  }
</style>
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
                  <div class="card-title text-slate-900 dark:text-white">{{ __('Edit Category') }}</div>
                </div>
              </header>
      

              <form class="space-y-4" 
      action="{{ route('categories.update', $category->id) }}" 
      method="POST" 
      enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="lang" value="{{ $lang }}">

    <div class="grid grid-cols-1 gap-7">
        <!-- Name -->
        <div class="input-area relative">
            <label for="largeInput" class="form-label">Name ({{ strtoupper($lang) }})</label>
            <input type="text" name="name" class="form-control" 
                   value="{{ $category->translations->first()->name ?? '' }}">
        </div>

        <!-- Thumb Image -->
        <div class="input-area">
            <label for="imageInput" class="form-label">Thumb Image</label>
            <input type="file" id="imageInput" name="thumb_image" accept="image/*" class="hidden">
            
            @if($category->thumb_image)
                <div id="previewContainer" class="mt-4 relative w-[100px] h-[100px]">
                    <img src="{{ asset('storage/'.$category->thumb_image) }}" 
                         class="rounded-lg w-[100px] h-[100px] object-cover border border-slate-200" alt="Current Image">
                </div>
            @endif
        </div>

        <!-- Thumb Icon -->
        <div class="input-area">
            <label for="imageInput1" class="form-label">Thumb Icon</label>
            <input type="file" id="imageInput1" name="thumb_icon" accept="image/*" class="hidden">

            @if($category->thumb_icon)
                <div id="previewContainer1" class="mt-4 relative w-[100px] h-[100px]">
                    <img src="{{ asset('storage/'.$category->thumb_icon) }}" 
                         class="rounded-lg w-[100px] h-[100px] object-cover border border-slate-200" alt="Current Icon">
                </div>
            @endif
        </div>
    </div>

    <button class="btn inline-flex justify-center btn-dark mt-4">Update</button>
</form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div> @endsection <script>
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