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
    background-color: #1e293b; /* bg-primary-600 (Tailwind blue-600) */
    color: #fff;
    border-color: #1e293b;
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
              <a href="{{ route('thingtodos.index') }}">
                <iconify-icon icon="heroicons-outline:home"></iconify-icon>
                <iconify-icon icon="heroicons-outline:chevron-right" class="text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
              </a>
            </li>
            <li class="inline-block text-sm text-slate-500">
              {{ $model->id ? 'Edit Things To Do' : 'Add Things To Do' }}
            </li>
          </ul>
        </div>

        <div class="grid xl:grid-cols-1 grid-cols-12 gap-6 px-6">
          <div class="card xl:col-span-2">
            <div class="card-body flex flex-col p-6">
              <header class="flex mb-5 items-center border-b pb-5">
                <div class="flex-1">
                  <div class="card-title text-slate-900 dark:text-white">
                    {{ $model->id ? 'Edit Things To Do' : 'Add Things To Do' }}
                  </div>
                </div>
              </header>

              <form action="{{ route('thingtodos.save') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
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

                        

                        {{-- About --}}
                        <div class="input-area">
                          <label class="form-label">  About ({{ strtoupper($lang->code) }})
                          @if($lang->code === 'en') <span class="text-red-500">*</span> @endif</label>
                          <textarea id="editor-{{ $lang->code }}"
                                    name="translations[{{ $lang->id }}][about]"
                                    class="form-control editor">{{ old("translations.$lang->id.about", $trans->about ?? '') }}</textarea>
                          @error("translations.$lang->id.about")
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                          @enderror
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
                

                {{-- city Select box --}}
                <div class="input-area">
                  <label for="city" class="form-label">City</label>
                    <select id="city" name="city_id" class="form-control">
                        @foreach($cities as $id => $name)
                            <option value="{{ $id }}" 
                                    class="dark:bg-slate-700" 
                                    {{ old('city_id', $model->city_id) == $id ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                    @error('city_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- category Select box --}}
                <div class="input-area">
                  <label for="category" class="form-label">Category</label>
                    <select id="category" name="category_id" class="form-control">
                        @foreach($categories as $c_id => $c_name)
                            <option value="{{ $c_id }}" 
                                    class="dark:bg-slate-700" 
                                    {{ old('category_id', $model->category_id) == $c_id ? 'selected' : '' }}>
                                {{ $c_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Slug --}}
                  <input type="hidden" name="slug" class="form-control" value="{{ old('slug', $model->slug) }}">
                
                <header class="flex mb-5 items-center pb-5 pt-5">
                <div class="flex-1">
                  <div class="card-title text-slate-900 dark:text-white">
                   Media
                  </div>
                </div>
              </header>

                

                {{-- Thumb Image --}}
                <div class="input-area relative">
                  <label class="form-label">Thumb Image</label>
                  <input type="file" id="imageInput" name="thumb_image" class="form-control" accept="image/*">
                  @error('thumb_image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                  @enderror

                  <div id="previewContainer" class="mt-4 relative pb-10 {{ $model->image ? '' : 'hidden' }}">
                    <img id="previewImage"
                         src="{{ $model->image ? asset('storage/'.$model->image) : '#' }}"
                         alt="Preview"
                         class="rounded border border-slate-200"
                         style="width: 50px; height: 50px;">

                         
                 
                  </div>
                </div>

                <div class="input-area mt-4">
                <label class="form-label">Gallery Images</label>
                <input type="file" id="galleryInput" name="gallery_images[]" class="form-control" accept="image/*" multiple>

                {{-- Existing images from DB --}}
                @if($model->galleryImages && $model->galleryImages->count())
                    <div class="mt-3 grid grid-cols-12 gap-3" id="existingGallery">
                    @foreach($model->galleryImages as $img)
                        <div class="relative w-14 h-14 border rounded overflow-hidden">
                        <img src="{{ asset('storage/'.$img->image_path) }}" 
                            class="w-14 h-14 object-cover rounded">

                        <button type="button"
                                class="absolute top-0 left-0 m-1 bg-red-500 text-white rounded-full text-xs px-1 py-0.5 rounded delete-image"
                                data-url="{{ route('thingtodos.gallery.delete', $img->id) }}">
                            ✕
                        </button>
                        </div>
                    @endforeach
                    </div>
                @endif

                {{-- New images preview (before upload) --}}
                <div id="galleryPreview" class="mt-4 grid grid-cols-12 gap-3"></div>
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


@include('backend.includes.commonjs')

@endsection




