@extends('backend.layout') 
@section('content')

<style>
    #file-preview img{height: 4rem;}
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

                        <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">
                            Basic Form</li>
                    </ul>
                </div>
                <!-- END: BreadCrumb -->
                <div class="grid xl:grid-cols-1 grid-cols-12 gap-6 px-6">
                    <!-- Basic Inputs -->
                    <div class="card xl:col-span-2">
                        <div class="card-body flex flex-col p-6">
                            <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                                <div class="flex-1">
                                    <div class="card-title text-slate-900 dark:text-white">Basic Form</div>
                                </div>
                            </header>
                            <div class="card-text h-full ">
                                <form class="space-y-4">
                                    <div class="grid grid-cols-1 gap-7">
                                        <div class="input-area relative">
                                            <label for="largeInput" class="form-label">Name</label>
                                            <input type="text" class="form-control" placeholder="Full Name" name="name" required>
                                        </div>

                                        <div class="input-area">
                                            <label for="select" class="form-label">Country</label>
                                            <select id="select" class="form-control">
                                                <option value="option1" class="dark:bg-slate-700">Country 1</option>
                                                <option value="option2" class="dark:bg-slate-700">Country 2</option>
                                                <option value="option3" class="dark:bg-slate-700">Country 3</option>
                                                <option value="option4" class="dark:bg-slate-700">Country 4</option>
                                            </select>
                                        </div>
                                        <div class="input-area">
                                            <label for="largeInput" class="form-label"> single image</label>
                                            <label>
                                                <input type="file" id="imageInput" name="image" class="hidden" accept="image/*">
                                                <span class="w-full h-[40px] file-control flex items-center custom-class">
                             <span class="flex-1 overflow-hidden text-ellipsis whitespace-nowrap">
                                <span class="text-slate-400">Choose a file or drop it here...</span>
                                                </span>
                                                <span class="file-name flex-none cursor-pointer border-l px-4 border-slate-200 dark:border-slate-700 h-full inline-flex items-center bg-slate-100 dark:bg-slate-900 text-slate-600 dark:text-slate-400 text-sm rounded-tr rounded-br font-normal">Browse</span>
                                                </span>
                                            </label>
                                            {{-- Preview Container --}}
                                            <div id="previewContainer" class="mt-4 relative hidden w-21 h-21">
                                                <img id="previewImage" src="#" alt="Preview" class="rounded-lg w-30 h-30 object-cover border border-slate-200" />
                                                <button type="button" id="removeImageBtn" class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs">✕</button>
                                            </div>

                                        </div>

                                        <div class="card-text h-full space-y-6">
                                            <div class="input-area">
                                                <div class="filegroup">
                                                    <label for="largeInput" class="form-label"> Multipul image</label>
                                                    <label>
                                                        <input type="file" id="imagesInput1" class="w-full hidden" name="images[]" multiple accept=".jpg, .jpeg, .png, .gif">
                                                        <span class="w-full h-[40px] file-control flex items-center custom-class">
                  <span class="flex-1 overflow-hidden text-ellipsis whitespace-nowrap">
                    <span id="placeholder" class="text-slate-400"> select files</span>
                                                        </span>
                                                        <span class="file-name flex-none cursor-pointer border-l px-4 border-slate-200 dark:border-slate-700 h-full inline-flex items-center bg-slate-100 dark:bg-slate-900 text-slate-600 dark:text-slate-400 text-sm rounded-tr rounded-br font-normal">Browse</span>
                                                        </span>
                                                    </label>
                                                </div>

                                                <!-- Image preview container -->
                                                <div id="file-preview" class="flex flex-wrap gap-4 mt-4"></div>

                                            </div>
                                        </div>



                                        <div class="card-text h-full space-y-4">
                                            <div class="input-area">
                                                <label for="editor" class="form-label">Description</label>
                                                <textarea id="editor" name="description" class="form-control" placeholder="Write something here...">{{ old('description', $model->description ?? '') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="checkbox-area">

                                            <label for="textarea" class="form-label">Radio button</label>

                                            <div class="card-text h-full space-y-4">
                                                <div class="flex items-center space-x-7 flex-wrap">
                                                    <div class="basicRadio">
                                                        <label class="flex items-center cursor-pointer">
                                                            <input type="radio" class="hidden" name="basicradios" value="secondary-500" checked="checked">
                                                            <span class="flex-none bg-white dark:bg-slate-500 rounded-full border inline-flex ltr:mr-2 rtl:ml-2 relative transition-all
                                        duration-150 h-[16px] w-[16px] border-slate-400 dark:border-slate-600 dark:ring-slate-700"></span>
                                                            <span class="text-secondary-500 text-sm leading-6 capitalize">Checked</span>
                                                        </label>
                                                    </div>
                                                    <div class="basicRadio">
                                                        <label class="flex items-center cursor-pointer">
                                                            <input type="radio" class="hidden" name="basicradios" value="secondary-500">
                                                            <span class="flex-none bg-white dark:bg-slate-500 rounded-full border inline-flex ltr:mr-2 rtl:ml-2 relative transition-all
                                            duration-150 h-[16px] w-[16px] border-slate-400 dark:border-slate-600 dark:ring-slate-700"></span>
                                                            <span class="text-secondary-500 text-sm leading-6 capitalize">Unchecked</span>
                                                        </label>
                                                    </div>

                                                </div>
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
                                            <span class="text-slate-500 dark:text-slate-400 text-sm leading-6">Remember me</span>
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
    document.addEventListener('DOMContentLoaded', function() {
      ClassicEditor
        .create(document.querySelector('#editor'), {
          toolbar: [
            'heading', '|',
            'bold', 'italic', 'underline', '|',
            'link', 'bulletedList', 'numberedList', '|',
            'blockQuote', 'undo', 'redo'
          ]
        })
        .then(editor => {
          console.log('CKEditor initialized:', editor);
        })
        .catch(error => {
          console.error('CKEditor Error:', error);
        });
    });
</script>

<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
      const imageInput = document.getElementById("imageInput");
      const previewContainer = document.getElementById("previewContainer");
      const previewImage = document.getElementById("previewImage");
      const removeImageBtn = document.getElementById("removeImageBtn");
      const fileName = document.getElementById("fileName");
    
      imageInput.addEventListener("change", function (event) {
        const file = event.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function (e) {
            previewImage.src = e.target.result;
            previewContainer.classList.remove("hidden");
            fileName.textContent = file.name;
          };
          reader.readAsDataURL(file);
        }
      });
    
      removeImageBtn.addEventListener("click", function () {
        previewContainer.classList.add("hidden");
        previewImage.src = "#";
        fileName.textContent = "Choose a file...";
        imageInput.value = "";
      });
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
      const input = document.getElementById("imagesInput1");
      const previewContainer = document.getElementById("file-preview");
      const placeholder = document.getElementById("placeholder");
      let selectedFiles = [];
    
      // When files are selected
      input.addEventListener("change", function (event) {
        const newFiles = Array.from(event.target.files);
        selectedFiles = selectedFiles.concat(newFiles);
        renderPreviews();
      });
    
      // Function to render image previews
      function renderPreviews() {
        previewContainer.innerHTML = "";
    
        selectedFiles.forEach((file, index) => {
          const reader = new FileReader();
    
          reader.onload = function (e) {
            const wrapper = document.createElement("div");
            wrapper.className = "relative w-24 h-24";
    
            wrapper.innerHTML = `
              <img src="${e.target.result}" 
                   alt="Preview"
                   class="w-full h-full object-cover rounded-lg border border-slate-300 shadow-sm">
              <button type="button"
                      data-index="${index}"
                      class="remove-btn absolute -top-2 -right-2 bg-red-500 text-white 
                             rounded-full w-6 h-6 flex items-center justify-center text-xs 
                             hover:bg-red-600 shadow-md">
                ✕
              </button>
            `;
            previewContainer.appendChild(wrapper);
          };
    
          reader.readAsDataURL(file);
        });
    
        placeholder.textContent = selectedFiles.length
          ? `${selectedFiles.length} file(s) selected`
          : "Select files";
      }
    
      // Remove an image on ❌ click
      previewContainer.addEventListener("click", function (e) {
        if (e.target.classList.contains("remove-btn")) {
          const index = parseInt(e.target.dataset.index);
          selectedFiles.splice(index, 1);
          updateInputFiles();
          renderPreviews();
        }
      });
    
      // Update the <input> files list
      function updateInputFiles() {
        const dataTransfer = new DataTransfer();
        selectedFiles.forEach(file => dataTransfer.items.add(file));
        input.files = dataTransfer.files;
      }
    });
</script>