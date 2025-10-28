@extends('backend.layout')
@section('content')
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
                <iconify-icon icon="heroicons-outline:chevron-right"
                  class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
              </a>
            </li>

            <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">
              Edit Profile</li>
          </ul>
        </div>
        <!-- END: BreadCrumb -->
        <div class="grid xl:grid-cols-1 grid-cols-1 gap-6">
          <!-- Basic Inputs -->
          <div class="card">
            <div class="card-body flex flex-col p-6">
              <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                <div class="flex-1">
                  <div class="card-title text-slate-900 dark:text-white">Edit Profile</div>
                </div>
              </header>
              <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
              <div class="card-text h-full space-y-4">

                <div class="input-area">
                  <label for="name" class="form-label">Name</label>
                  <input id="name" name="name" type="text" class="form-control" placeholder="name"  value="{{ old('name', $user->name) }}">
                </div>
                <div class="input-area">
                  <label for="readonly" class="form-label">Email</label>
                  <input id="readonly" name="email" type="email" class="form-control" placeholder="email" readonly="readonly" value="{{ $user->email }}">
                </div>
                <div class="input-area">
                  <label for="password" class="form-label">Password</label>
                  <input id="password" type="password" name="password" class="form-control" placeholder="password">
                </div>
                
                <div class="input-area">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control"
                      placeholder="Confirm new password">
                  </div>

                <div class="input-area">
                  <label for="image" class="form-label">Image</label>
                  <div class="card-text h-full space-y-6">
                    <div class="input-area">
                      <div class="filegroup">
                        <label>
                          
                        <input type="file" class=" w-full hidden" name="image">
                          <span class="w-full h-[40px] file-control flex items-center custom-class">
                            <span class="flex-1 overflow-hidden text-ellipsis whitespace-nowrap"> <span
                                class="text-slate-400">Choose a file...</span> </span>
                            <span
                              class="file-name flex-none cursor-pointer border-l px-4 border-slate-200 dark:border-slate-700 h-full inline-flex items-center bg-slate-100 dark:bg-slate-900 text-slate-600 dark:text-slate-400 text-sm rounded-tr rounded-br font-normal">Browse</span>
                          </span>
                          @if($user->image)
            <img src="{{ asset('uploads/profile/' . $user->image) }}" alt="Profile Image" class="w-24 mt-2 rounded-full">
        @endif
                        </label>
                      </div>

                    </div>
                  </div>
                </div>

                <div class="input-area mt-4">
                  <button class="btn btn-dark block  text-center" type="submit">Submit</button>
                </div>
              </div>

              </form>
              
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
</div>

@endsection