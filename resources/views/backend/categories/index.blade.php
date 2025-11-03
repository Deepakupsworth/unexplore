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
              <a href="{{ asset('/admin/dashboard') }}">
                <iconify-icon icon="heroicons-outline:home"></iconify-icon>
                <iconify-icon icon="heroicons-outline:chevron-right"
                  class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
              </a>
            </li>
            <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">
              Categories List
            </li>
          </ul>
        </div>
        <!-- END: BreadCrumb -->

        <div class="card">
          <header class="card-header noborder flex justify-between items-center">
            <h4 class="card-title">Categories Table</h4>
            <a href="{{ route('categories.create') }}"
               class="btn bg-primary-600 text-white text-sm px-4 py-2 rounded">
              + Add Category
            </a>
          </header>

          <div class="card-body px-6 pb-6">
            <div class="overflow-x-auto -mx-6 dashcode-data-table">
              <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden">
                  <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700" id="data-table">
                    <thead class="border-t border-slate-100 dark:border-slate-800">
                      <tr>
                        <th scope="col" class="table-th w-12">#</th>
                        <th scope="col" class="table-th">Name</th>
                        <th scope="col" class="table-th">thumb image</th>
                        <th scope="col" class="table-th">thumb icon</th>

                        <th scope="col" class="table-th w-32">Action</th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">

                      @forelse ($categories as $key => $cat)
                        <tr>
                          <td class="table-td">{{ $key + 1 }}</td>
                          <td class="table-td">{{ $cat->translations->first()->name ?? '-' }}</td>
                          <td class="table-td">
                            <img src="{{ $cat->thumb_image ? asset('storage/'.$cat->thumb_image) : '#' }}" alt="Thumb Image" class="w-12 h-12 object-cover">
                          </td>
                          <td class="table-td">
                            <img src="{{ $cat->thumb_icon ? asset('storage/'.$cat->thumb_icon) : '#' }}" alt="Thumb Icon" class="w-12 h-12 object-cover">
                          </td>
                          <td class="table-td">
                            <div class="relative">
                              <div class="dropdown relative">
                                <button class="text-xl text-left block w-full"
                                        type="button"
                                        id="tableDropdownMenuButton{{ $cat->id }}"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                  <iconify-icon icon="heroicons-outline:dots-vertical"></iconify-icon>
                                </button>
                                <ul class="dropdown-menu min-w-[120px] absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700
                                  shadow z-[2] float-left overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">

                                  <li>
                                    <a href="{{ route('categories.edit', $cat->id) }}"
                                       class="hover:bg-slate-900 hover:text-white dark:hover:bg-slate-600 w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm flex space-x-2 items-center">
                                      <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                      <span>Edit</span>
                                    </a>
                                  </li>
                                  
                                  <li>
                                          <form 
                                              action="{{ route('categories.delete', $cat->id) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Are you sure you want to delete this category?')"
                                          >
                                              @csrf
                                              @method('DELETE')

                                              <button 
                                                  type="submit" 
                                                  class="hover:bg-slate-900 hover:text-white dark:hover:bg-slate-600 w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm flex space-x-2 items-center"
                                              >
                                                  <iconify-icon icon="heroicons:trash" class="pr-2"></iconify-icon> 
                                                  Delete
                                              </button>
                                          </form>
                                      </li>
                                </ul>
                              </div>
                            </div>
                          </td>
                        </tr>
                      @empty
                        <tr>
                          <td colspan="5" class="text-center py-4 text-slate-500">No categories found</td>
                        </tr>
                      @endforelse

                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="mt-5">
              {{ $categories->links() }}
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

@endsection
