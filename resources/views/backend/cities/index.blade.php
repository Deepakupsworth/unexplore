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
              Cities List
            </li>
          </ul>
        </div>
        <!-- END: BreadCrumb -->

        <div class="card">
          <header class="card-header noborder flex justify-between items-center">
            <h4 class="card-title">Cities Table</h4>
            <a href="{{ route('cities.create') }}" 
               class="btn bg-primary-600 text-white text-sm px-4 py-2 rounded">
              + Add City
            </a>
          </header>

          <div class="card-body px-6 pb-6">
            <div class="overflow-x-auto -mx-6 dashcode-data-table">
              <span class="col-span-8 hidden"></span>
              <span class="col-span-4 hidden"></span>
              <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden">
                  <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700" id="data-table">
                    <thead class="border-t border-slate-100 dark:border-slate-800">
                      <tr>
                        <th scope="col" class="table-th">ID</th>
                        <th scope="col" class="table-th">Thumb</th>
                        <th scope="col" class="table-th">Name (EN)</th>
                        <th scope="col" class="table-th">Slug</th>
                        <th scope="col" class="table-th">Created At</th>
                        <th scope="col" class="table-th">Action</th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                      
                      @forelse($cities as $city)
                        <tr>
                          <td class="table-td">{{ $city->id }}</td>
                          
                          <td class="table-td">
                            @if($city->thumb_image)
                              <img src="{{ asset('storage/'.$city->thumb_image) }}" 
                                   alt="thumb" class="w-12 h-12 rounded object-cover">
                            @else
                              <span class="text-xs text-slate-400">No Image</span>
                            @endif
                          </td>

                          <td class="table-td">
                            {{ optional($city->translations->where('language.code', 'en')->first())->name ?? '—' }}
                          </td>

                          <td class="table-td">{{ $city->slug }}</td>
                          <td class="table-td">{{ $city->created_at->format('d M Y') }}</td>

                          <td class="table-td">
                            <div>
                              <div class="relative">
                                <div class="dropdown relative">
                                  <button class="text-xl text-center block w-full" 
                                          type="button" id="tableDropdownMenuButton{{ $city->id }}" 
                                          data-bs-toggle="dropdown" aria-expanded="false">
                                    <iconify-icon icon="heroicons-outline:dots-vertical"></iconify-icon>
                                  </button>
                                  <ul class="dropdown-menu min-w-[120px] absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700
                                    shadow z-[2] float-left overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">
                                    
                                    <li>
                                      <a href="{{ route('cities.edit', $city->id) }}" 
                                         class="hover:bg-slate-900 hover:text-white dark:hover:bg-slate-600 w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm flex space-x-2 items-center">
                                        <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                        <span>Edit</span>
                                      </a>
                                    </li>

                                    <li>
                                     
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                      @empty
                        <tr>
                          <td colspan="6" class="text-center py-4 text-slate-500">No cities found</td>
                        </tr>
                      @endforelse

                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="mt-5">
              {{ $cities->links() }}
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
</div>

@endsection
