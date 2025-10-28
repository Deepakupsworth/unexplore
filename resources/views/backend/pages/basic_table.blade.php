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
                                <iconify-icon icon="heroicons-outline:chevron-right" class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
                            </a>
                        </li>

                        <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">
                            Basic table</li>
                    </ul>
                </div>
                <!-- END: BreadCrumb -->

                <div class="card">
                    <header class=" card-header noborder">
                      <h4 class="card-title">Advanced Table
                      </h4>
                    </header>
                    <div class="card-body px-6 pb-6">
                      <div class="overflow-x-auto -mx-6 dashcode-data-table">
                        <span class=" col-span-8  hidden"></span>
                        <span class="  col-span-4 hidden"></span>
                        <div class="inline-block min-w-full align-middle">
                          <div class="overflow-hidden ">
                            <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700" id="data-table">
                              <thead class=" border-t border-slate-100 dark:border-slate-800">
                                <tr>

                                  <th scope="col" class=" table-th ">
                                    Id
                                  </th>

                                  <th scope="col" class=" table-th ">
                                    Order
                                  </th>

                                  <th scope="col" class=" table-th ">
                                    Customer
                                  </th>

                                  <th scope="col" class=" table-th ">
                                    Date
                                  </th>

                                  <th scope="col" class=" table-th ">
                                    Quantity
                                  </th>

                                  <th scope="col" class=" table-th ">
                                    Amount
                                  </th>

                                  <th scope="col" class=" table-th ">
                                    Status
                                  </th>

                                  <th scope="col" class=" table-th ">
                                    Action
                                  </th>

                                </tr>
                              </thead>
                              <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                              <tr>
                                  <td class="table-td">1</td>
                                  <td class="table-td ">#951</td>
                                  <td class="table-td">
                                    <span class="flex">
                          <span class="w-7 h-7 rounded-full ltr:mr-3 rtl:ml-3 flex-none">
                            <img src="backend/images/all-img/customer_1.png" alt="1" class="object-cover w-full h-full rounded-full">
                          </span>
                                    <span class="text-sm text-slate-600 dark:text-slate-300 capitalize">Jenny Wilson</span>
                                    </span>
                                  </td>
                                  <td class="table-td ">3/26/2022</td>
                                  <td class="table-td ">
                                    <div>
                                      13
                                    </div>
                                  </td>
                                  <td class="table-td ">
                                    <div>
                                      $1779.53
                                    </div>
                                  </td>
                                  <td class="table-td ">

                                    <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-success-500
                              bg-success-500">
                                      paid
                                    </div>

                                  </td>
                                  <td class="table-td ">
                                    <div>
                                      <div class="relative">
                                        <div class="dropdown relative">
                                          <button class="text-xl text-center block w-full " type="button" id="tableDropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <iconify-icon icon="heroicons-outline:dots-vertical"></iconify-icon>
                                          </button>
                                          <ul class=" dropdown-menu min-w-[120px] absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700
                                  shadow z-[2] float-left overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">
                                  <li>
                                              <a href="invoive-preview.html" class=" hover:bg-slate-900 hover:text-white dark:hover:bg-slate-600 dark:hover:bg-opacity-50 w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:eye"></iconify-icon>
                                    </span>
                                                <span class="text-sm">View</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="invoive-preview.html" class=" hover:bg-slate-900 hover:text-white dark:hover:bg-slate-600 dark:hover:bg-opacity-50 w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                    </span>
                                                <span class="text-sm">Edit</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="#" class=" bg-danger-500 text-danger-500 bg-opacity-30 hover:bg-opacity-100 hover:text-white w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer last:rounded-b flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:trash"></iconify-icon>
                                    </span>
                                                <span class="text-sm">Delete</span>
                                              </a>
                                            </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                </tr>

                                <tr>
                                  <td class="table-td">2</td>
                                  <td class="table-td ">#238</td>
                                  <td class="table-td">
                                    <span class="flex">
                          <span class="w-7 h-7 rounded-full ltr:mr-3 rtl:ml-3 flex-none">
                            <img src="backend/images/all-img/customer_1.png" alt="2" class="object-cover w-full h-full rounded-full">
                          </span>
                                    <span class="text-sm text-slate-600 dark:text-slate-300 capitalize">Jenny Wilson</span>
                                    </span>
                                  </td>
                                  <td class="table-td ">2/6/2022</td>
                                  <td class="table-td ">
                                    <div>
                                      13
                                    </div>
                                  </td>
                                  <td class="table-td ">
                                    <div>
                                      $2215.78
                                    </div>
                                  </td>
                                  <td class="table-td ">

                                    <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-warning-500
                              bg-warning-500">
                                      due
                                    </div>

                                  </td>
                                  <td class="table-td ">
                                    <div>
                                      <div class="relative">
                                        <div class="dropdown relative">
                                          <button class="text-xl text-center block w-full " type="button" id="tableDropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                            <iconify-icon icon="heroicons-outline:dots-vertical"></iconify-icon>
                                          </button>
                                          <ul class=" dropdown-menu min-w-[120px] absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700
                                  shadow z-[2] float-left overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">
                                  <li>
                                              <a href="invoive-preview.html" class=" hover:bg-slate-900 hover:text-white dark:hover:bg-slate-600 dark:hover:bg-opacity-50 w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:eye"></iconify-icon>
                                    </span>
                                                <span class="text-sm">View</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="invoive-preview.html" class=" hover:bg-slate-900 hover:text-white dark:hover:bg-slate-600 dark:hover:bg-opacity-50 w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                    </span>
                                                <span class="text-sm">Edit</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="#" class=" bg-danger-500 text-danger-500 bg-opacity-30 hover:bg-opacity-100 hover:text-white w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer last:rounded-b flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:trash"></iconify-icon>
                                    </span>
                                                <span class="text-sm">Delete</span>
                                              </a>
                                            </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                </tr>

                                <tr>
                                  <td class="table-td">3</td>
                                  <td class="table-td ">#339</td>
                                  <td class="table-td">
                                    <span class="flex">
                          <span class="w-7 h-7 rounded-full ltr:mr-3 rtl:ml-3 flex-none">
                            <img src="backend/images/all-img/customer_1.png" alt="3" class="object-cover w-full h-full rounded-full">
                          </span>
                                    <span class="text-sm text-slate-600 dark:text-slate-300 capitalize">Jenny Wilson</span>
                                    </span>
                                  </td>
                                  <td class="table-td ">9/6/2021</td>
                                  <td class="table-td ">
                                    <div>
                                      1
                                    </div>
                                  </td>
                                  <td class="table-td ">
                                    <div>
                                      $3183.60
                                    </div>
                                  </td>
                                  <td class="table-td ">

                                    <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-warning-500
                              bg-warning-500">
                                      due
                                    </div>

                                  </td>
                                  <td class="table-td ">
                                    <div>
                                      <div class="relative">
                                        <div class="dropdown relative">
                                          <button class="text-xl text-center block w-full " type="button" id="tableDropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                            <iconify-icon icon="heroicons-outline:dots-vertical"></iconify-icon>
                                          </button>
                                          <ul class=" dropdown-menu min-w-[120px] absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700
                                  shadow z-[2] float-left overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">
                                  <li>
                                              <a href="invoive-preview.html" class=" hover:bg-slate-900 hover:text-white dark:hover:bg-slate-600 dark:hover:bg-opacity-50 w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:eye"></iconify-icon>
                                    </span>
                                                <span class="text-sm">View</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="invoive-preview.html" class=" hover:bg-slate-900 hover:text-white dark:hover:bg-slate-600 dark:hover:bg-opacity-50 w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                    </span>
                                                <span class="text-sm">Edit</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="#" class=" bg-danger-500 text-danger-500 bg-opacity-30 hover:bg-opacity-100 hover:text-white w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer last:rounded-b flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:trash"></iconify-icon>
                                    </span>
                                                <span class="text-sm">Delete</span>
                                              </a>
                                            </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                </tr>

                                <tr>
                                  <td class="table-td">4</td>
                                  <td class="table-td ">#365</td>
                                  <td class="table-td">
                                    <span class="flex">
                          <span class="w-7 h-7 rounded-full ltr:mr-3 rtl:ml-3 flex-none">
                            <img src="backend/images/all-img/customer_1.png" alt="4" class="object-cover w-full h-full rounded-full">
                          </span>
                                    <span class="text-sm text-slate-600 dark:text-slate-300 capitalize">Jenny Wilson</span>
                                    </span>
                                  </td>
                                  <td class="table-td ">11/7/2021</td>
                                  <td class="table-td ">
                                    <div>
                                      13
                                    </div>
                                  </td>
                                  <td class="table-td ">
                                    <div>
                                      $2587.86
                                    </div>
                                  </td>
                                  <td class="table-td ">

                                    <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-danger-500
                              bg-danger-500">
                                      cancled
                                    </div>

                                  </td>
                                  <td class="table-td ">
                                    <div>
                                      <div class="relative">
                                        <div class="dropdown relative">
                                          <button class="text-xl text-center block w-full " type="button" id="tableDropdownMenuButton4" data-bs-toggle="dropdown" aria-expanded="false">
                                            <iconify-icon icon="heroicons-outline:dots-vertical"></iconify-icon>
                                          </button>
                                          <ul class=" dropdown-menu min-w-[120px] absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700
                                  shadow z-[2] float-left overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">
                                  <li>
                                              <a href="invoive-preview.html" class=" hover:bg-slate-900 hover:text-white dark:hover:bg-slate-600 dark:hover:bg-opacity-50 w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:eye"></iconify-icon>
                                    </span>
                                                <span class="text-sm">View</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="invoive-preview.html" class=" hover:bg-slate-900 hover:text-white dark:hover:bg-slate-600 dark:hover:bg-opacity-50 w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                    </span>
                                                <span class="text-sm">Edit</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="#" class=" bg-danger-500 text-danger-500 bg-opacity-30 hover:bg-opacity-100 hover:text-white w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer last:rounded-b flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:trash"></iconify-icon>
                                    </span>
                                                <span class="text-sm">Delete</span>
                                              </a>
                                            </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                </tr>

                                <tr>
                                  <td class="table-td">5</td>
                                  <td class="table-td ">#513</td>
                                  <td class="table-td">
                                    <span class="flex">
                          <span class="w-7 h-7 rounded-full ltr:mr-3 rtl:ml-3 flex-none">
                            <img src="backend/images/all-img/customer_1.png" alt="5" class="object-cover w-full h-full rounded-full">
                          </span>
                                    <span class="text-sm text-slate-600 dark:text-slate-300 capitalize">Jenny Wilson</span>
                                    </span>
                                  </td>
                                  <td class="table-td ">5/6/2022</td>
                                  <td class="table-td ">
                                    <div>
                                      12
                                    </div>
                                  </td>
                                  <td class="table-td ">
                                    <div>
                                      $3840.73
                                    </div>
                                  </td>
                                  <td class="table-td ">

                                    <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-success-500
                              bg-success-500">
                                      paid
                                    </div>

                                  </td>
                                  <td class="table-td ">
                                    <div>
                                      <div class="relative">
                                        <div class="dropdown relative">
                                          <button class="text-xl text-center block w-full " type="button" id="tableDropdownMenuButton5" data-bs-toggle="dropdown" aria-expanded="false">
                                            <iconify-icon icon="heroicons-outline:dots-vertical"></iconify-icon>
                                          </button>
                                          <ul class=" dropdown-menu min-w-[120px] absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700
                                  shadow z-[2] float-left overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">
                                  <li>
                                              <a href="invoive-preview.html" class=" hover:bg-slate-900 hover:text-white dark:hover:bg-slate-600 dark:hover:bg-opacity-50 w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:eye"></iconify-icon>
                                    </span>
                                                <span class="text-sm">View</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="invoive-preview.html" class=" hover:bg-slate-900 hover:text-white dark:hover:bg-slate-600 dark:hover:bg-opacity-50 w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                    </span>
                                                <span class="text-sm">Edit</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="#" class=" bg-danger-500 text-danger-500 bg-opacity-30 hover:bg-opacity-100 hover:text-white w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer last:rounded-b flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:trash"></iconify-icon>
                                    </span>
                                                <span class="text-sm">Delete</span>
                                              </a>
                                            </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                </tr>

                                <tr>
                                  <td class="table-td">6</td>
                                  <td class="table-td ">#534</td>
                                  <td class="table-td">
                                    <span class="flex">
                          <span class="w-7 h-7 rounded-full ltr:mr-3 rtl:ml-3 flex-none">
                            <img src="backend/images/all-img/customer_1.png" alt="6" class="object-cover w-full h-full rounded-full">
                          </span>
                                    <span class="text-sm text-slate-600 dark:text-slate-300 capitalize">Jenny Wilson</span>
                                    </span>
                                  </td>
                                  <td class="table-td ">2/14/2022</td>
                                  <td class="table-td ">
                                    <div>
                                      12
                                    </div>
                                  </td>
                                  <td class="table-td ">
                                    <div>
                                      $4764.18
                                    </div>
                                  </td>
                                  <td class="table-td ">

                                    <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-danger-500
                              bg-danger-500">
                                      cancled
                                    </div>

                                  </td>
                                  <td class="table-td ">
                                    <div>
                                      <div class="relative">
                                        <div class="dropdown relative">
                                          <button class="text-xl text-center block w-full " type="button" id="tableDropdownMenuButton6" data-bs-toggle="dropdown" aria-expanded="false">
                                            <iconify-icon icon="heroicons-outline:dots-vertical"></iconify-icon>
                                          </button>
                                          <ul class=" dropdown-menu min-w-[120px] absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700
                                  shadow z-[2] float-left overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">
                                  <li>
                                              <a href="invoive-preview.html" class=" hover:bg-slate-900 hover:text-white dark:hover:bg-slate-600 dark:hover:bg-opacity-50 w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:eye"></iconify-icon>
                                    </span>
                                                <span class="text-sm">View</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="invoive-preview.html" class=" hover:bg-slate-900 hover:text-white dark:hover:bg-slate-600 dark:hover:bg-opacity-50 w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                    </span>
                                                <span class="text-sm">Edit</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="#" class=" bg-danger-500 text-danger-500 bg-opacity-30 hover:bg-opacity-100 hover:text-white w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer last:rounded-b flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:trash"></iconify-icon>
                                    </span>
                                                <span class="text-sm">Delete</span>
                                              </a>
                                            </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                </tr>

                                <tr>
                                  <td class="table-td">7</td>
                                  <td class="table-td ">#77</td>
                                  <td class="table-td">
                                    <span class="flex">
                          <span class="w-7 h-7 rounded-full ltr:mr-3 rtl:ml-3 flex-none">
                            <img src="backend/images/all-img/customer_1.png" alt="7" class="object-cover w-full h-full rounded-full">
                          </span>
                                    <span class="text-sm text-slate-600 dark:text-slate-300 capitalize">Jenny Wilson</span>
                                    </span>
                                  </td>
                                  <td class="table-td ">7/30/2022</td>
                                  <td class="table-td ">
                                    <div>
                                      6
                                    </div>
                                  </td>
                                  <td class="table-td ">
                                    <div>
                                      $2875.05
                                    </div>
                                  </td>
                                  <td class="table-td ">

                                    <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-success-500
                              bg-success-500">
                                      paid
                                    </div>

                                  </td>
                                  <td class="table-td ">
                                    <div>
                                      <div class="relative">
                                        <div class="dropdown relative">
                                          <button class="text-xl text-center block w-full " type="button" id="tableDropdownMenuButton7" data-bs-toggle="dropdown" aria-expanded="false">
                                            <iconify-icon icon="heroicons-outline:dots-vertical"></iconify-icon>
                                          </button>
                                          <ul class=" dropdown-menu min-w-[120px] absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700
                                  shadow z-[2] float-left overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">
                                  <li>
                                              <a href="invoive-preview.html" class=" hover:bg-slate-900 hover:text-white dark:hover:bg-slate-600 dark:hover:bg-opacity-50 w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:eye"></iconify-icon>
                                    </span>
                                                <span class="text-sm">View</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="invoive-preview.html" class=" hover:bg-slate-900 hover:text-white dark:hover:bg-slate-600 dark:hover:bg-opacity-50 w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                    </span>
                                                <span class="text-sm">Edit</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="#" class=" bg-danger-500 text-danger-500 bg-opacity-30 hover:bg-opacity-100 hover:text-white w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer last:rounded-b flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:trash"></iconify-icon>
                                    </span>
                                                <span class="text-sm">Delete</span>
                                              </a>
                                            </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                </tr>

                                <tr>
                                  <td class="table-td">8</td>
                                  <td class="table-td ">#238</td>
                                  <td class="table-td">
                                    <span class="flex">
                          <span class="w-7 h-7 rounded-full ltr:mr-3 rtl:ml-3 flex-none">
                            <img src="backend/images/all-img/customer_1.png" alt="8" class="object-cover w-full h-full rounded-full">
                          </span>
                                    <span class="text-sm text-slate-600 dark:text-slate-300 capitalize">Jenny Wilson</span>
                                    </span>
                                  </td>
                                  <td class="table-td ">6/30/2022</td>
                                  <td class="table-td ">
                                    <div>
                                      9
                                    </div>
                                  </td>
                                  <td class="table-td ">
                                    <div>
                                      $2491.02
                                    </div>
                                  </td>
                                  <td class="table-td ">

                                    <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-warning-500
                              bg-warning-500">
                                      due
                                    </div>

                                  </td>
                                  <td class="table-td ">
                                    <div>
                                      <div class="relative">
                                        <div class="dropdown relative">
                                          <button class="text-xl text-center block w-full " type="button" id="tableDropdownMenuButton8" data-bs-toggle="dropdown" aria-expanded="false">
                                            <iconify-icon icon="heroicons-outline:dots-vertical"></iconify-icon>
                                          </button>
                                          <ul class=" dropdown-menu min-w-[120px] absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700
                                  shadow z-[2] float-left overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">
                                  <li>
                                              <a href="invoive-preview.html" class=" hover:bg-slate-900 hover:text-white dark:hover:bg-slate-600 dark:hover:bg-opacity-50 w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:eye"></iconify-icon>
                                    </span>
                                                <span class="text-sm">View</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="invoive-preview.html" class=" hover:bg-slate-900 hover:text-white dark:hover:bg-slate-600 dark:hover:bg-opacity-50 w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                    </span>
                                                <span class="text-sm">Edit</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="#" class=" bg-danger-500 text-danger-500 bg-opacity-30 hover:bg-opacity-100 hover:text-white w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer last:rounded-b flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:trash"></iconify-icon>
                                    </span>
                                                <span class="text-sm">Delete</span>
                                              </a>
                                            </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                </tr>

                                <tr>
                                  <td class="table-td">9</td>
                                  <td class="table-td ">#886</td>
                                  <td class="table-td">
                                    <span class="flex">
                          <span class="w-7 h-7 rounded-full ltr:mr-3 rtl:ml-3 flex-none">
                            <img src="backend/images/all-img/customer_1.png" alt="9" class="object-cover w-full h-full rounded-full">
                          </span>
                                    <span class="text-sm text-slate-600 dark:text-slate-300 capitalize">Jenny Wilson</span>
                                    </span>
                                  </td>
                                  <td class="table-td ">8/9/2022</td>
                                  <td class="table-td ">
                                    <div>
                                      8
                                    </div>
                                  </td>
                                  <td class="table-td ">
                                    <div>
                                      $3006.95
                                    </div>
                                  </td>
                                  <td class="table-td ">

                                    <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-warning-500
                              bg-warning-500">
                                      due
                                    </div>

                                  </td>
                                  <td class="table-td ">
                                    <div>
                                      <div class="relative">
                                        <div class="dropdown relative">
                                          <button class="text-xl text-center block w-full " type="button" id="tableDropdownMenuButton9" data-bs-toggle="dropdown" aria-expanded="false">
                                            <iconify-icon icon="heroicons-outline:dots-vertical"></iconify-icon>
                                          </button>
                                          <ul class=" dropdown-menu min-w-[120px] absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700
                                  shadow z-[2] float-left overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">
                                  <li>
                                              <a href="invoive-preview.html" class=" hover:bg-slate-900 hover:text-white dark:hover:bg-slate-600 dark:hover:bg-opacity-50 w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:eye"></iconify-icon>
                                    </span>
                                                <span class="text-sm">View</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="invoive-preview.html" class=" hover:bg-slate-900 hover:text-white dark:hover:bg-slate-600 dark:hover:bg-opacity-50 w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                    </span>
                                                <span class="text-sm">Edit</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="#" class=" bg-danger-500 text-danger-500 bg-opacity-30 hover:bg-opacity-100 hover:text-white w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer last:rounded-b flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:trash"></iconify-icon>
                                    </span>
                                                <span class="text-sm">Delete</span>
                                              </a>
                                            </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                </tr>

                                <tr>
                                  <td class="table-td">10</td>
                                  <td class="table-td ">#3</td>
                                  <td class="table-td">
                                    <span class="flex">
                          <span class="w-7 h-7 rounded-full ltr:mr-3 rtl:ml-3 flex-none">
                            <img src="backend/images/all-img/customer_1.png" alt="10" class="object-cover w-full h-full rounded-full">
                          </span>
                                    <span class="text-sm text-slate-600 dark:text-slate-300 capitalize">Jenny Wilson</span>
                                    </span>
                                  </td>
                                  <td class="table-td ">8/4/2022</td>
                                  <td class="table-td ">
                                    <div>
                                      12
                                    </div>
                                  </td>
                                  <td class="table-td ">
                                    <div>
                                      $2160.32
                                    </div>
                                  </td>
                                  <td class="table-td ">

                                    <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-success-500
                              bg-success-500">
                                      paid
                                    </div>

                                  </td>
                                  <td class="table-td ">
                                    <div>
                                      <div class="relative">
                                        <div class="dropdown relative">
                                          <button class="text-xl text-center block w-full " type="button" id="tableDropdownMenuButton10" data-bs-toggle="dropdown" aria-expanded="false">
                                            <iconify-icon icon="heroicons-outline:dots-vertical"></iconify-icon>
                                          </button>
                                          <ul class=" dropdown-menu min-w-[120px] absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700
                                  shadow z-[2] float-left overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">
                                  <li>
                                              <a href="invoive-preview.html" class=" hover:bg-slate-900 hover:text-white dark:hover:bg-slate-600 dark:hover:bg-opacity-50 w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:eye"></iconify-icon>
                                    </span>
                                                <span class="text-sm">View</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="invoive-preview.html" class=" hover:bg-slate-900 hover:text-white dark:hover:bg-slate-600 dark:hover:bg-opacity-50 w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                    </span>
                                                <span class="text-sm">Edit</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="#" class=" bg-danger-500 text-danger-500 bg-opacity-30 hover:bg-opacity-100 hover:text-white w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer last:rounded-b flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:trash"></iconify-icon>
                                    </span>
                                                <span class="text-sm">Delete</span>
                                              </a>
                                            </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                </tr>

                                <tr>
                                  <td class="table-td">11</td>
                                  <td class="table-td ">#198</td>
                                  <td class="table-td">
                                    <span class="flex">
                          <span class="w-7 h-7 rounded-full ltr:mr-3 rtl:ml-3 flex-none">
                            <img src="backend/images/all-img/customer_1.png" alt="11" class="object-cover w-full h-full rounded-full">
                          </span>
                                    <span class="text-sm text-slate-600 dark:text-slate-300 capitalize">Jenny Wilson</span>
                                    </span>
                                  </td>
                                  <td class="table-td ">4/5/2022</td>
                                  <td class="table-td ">
                                    <div>
                                      8
                                    </div>
                                  </td>
                                  <td class="table-td ">
                                    <div>
                                      $1272.66
                                    </div>
                                  </td>
                                  <td class="table-td ">

                                    <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-success-500
                              bg-success-500">
                                      paid
                                    </div>

                                  </td>
                                  <td class="table-td ">
                                    <div>
                                      <div class="relative">
                                        <div class="dropdown relative">
                                          <button class="text-xl text-center block w-full " type="button" id="tableDropdownMenuButton11" data-bs-toggle="dropdown" aria-expanded="false">
                                            <iconify-icon icon="heroicons-outline:dots-vertical"></iconify-icon>
                                          </button>
                                          <ul class=" dropdown-menu min-w-[120px] absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700
                                  shadow z-[2] float-left overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">
                                  <li>
                                              <a href="invoive-preview.html" class=" hover:bg-slate-900 hover:text-white dark:hover:bg-slate-600 dark:hover:bg-opacity-50 w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:eye"></iconify-icon>
                                    </span>
                                                <span class="text-sm">View</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="invoive-preview.html" class=" hover:bg-slate-900 hover:text-white dark:hover:bg-slate-600 dark:hover:bg-opacity-50 w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                    </span>
                                                <span class="text-sm">Edit</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="#" class=" bg-danger-500 text-danger-500 bg-opacity-30 hover:bg-opacity-100 hover:text-white w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer last:rounded-b flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:trash"></iconify-icon>
                                    </span>
                                                <span class="text-sm">Delete</span>
                                              </a>
                                            </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                </tr>

                                <tr>
                                  <td class="table-td">12</td>
                                  <td class="table-td ">#829</td>
                                  <td class="table-td">
                                    <span class="flex">
                          <span class="w-7 h-7 rounded-full ltr:mr-3 rtl:ml-3 flex-none">
                            <img src="backend/images/all-img/customer_1.png" alt="12" class="object-cover w-full h-full rounded-full">
                          </span>
                                    <span class="text-sm text-slate-600 dark:text-slate-300 capitalize">Jenny Wilson</span>
                                    </span>
                                  </td>
                                  <td class="table-td ">8/9/2022</td>
                                  <td class="table-td ">
                                    <div>
                                      2
                                    </div>
                                  </td>
                                  <td class="table-td ">
                                    <div>
                                      $4327.86
                                    </div>
                                  </td>
                                  <td class="table-td ">

                                    <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-danger-500
                              bg-danger-500">
                                      cancled
                                    </div>

                                  </td>
                                  <td class="table-td ">
                                    <div>
                                      <div class="relative">
                                        <div class="dropdown relative">
                                          <button class="text-xl text-center block w-full " type="button" id="tableDropdownMenuButton12" data-bs-toggle="dropdown" aria-expanded="false">
                                            <iconify-icon icon="heroicons-outline:dots-vertical"></iconify-icon>
                                          </button>
                                          <ul class=" dropdown-menu min-w-[120px] absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700
                                  shadow z-[2] float-left overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">
                                  <li>
                                              <a href="invoive-preview.html" class=" hover:bg-slate-900 hover:text-white dark:hover:bg-slate-600 dark:hover:bg-opacity-50 w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:eye"></iconify-icon>
                                    </span>
                                                <span class="text-sm">View</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="invoive-preview.html" class=" hover:bg-slate-900 hover:text-white dark:hover:bg-slate-600 dark:hover:bg-opacity-50 w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                    </span>
                                                <span class="text-sm">Edit</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="#" class=" bg-danger-500 text-danger-500 bg-opacity-30 hover:bg-opacity-100 hover:text-white w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer last:rounded-b flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:trash"></iconify-icon>
                                    </span>
                                                <span class="text-sm">Delete</span>
                                              </a>
                                            </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                </tr>

                                <tr>
                                  <td class="table-td">13</td>
                                  <td class="table-td ">#595</td>
                                  <td class="table-td">
                                    <span class="flex">
                          <span class="w-7 h-7 rounded-full ltr:mr-3 rtl:ml-3 flex-none">
                            <img src="backend/images/all-img/customer_1.png" alt="13" class="object-cover w-full h-full rounded-full">
                          </span>
                                    <span class="text-sm text-slate-600 dark:text-slate-300 capitalize">Jenny Wilson</span>
                                    </span>
                                  </td>
                                  <td class="table-td ">2/10/2022</td>
                                  <td class="table-td ">
                                    <div>
                                      11
                                    </div>
                                  </td>
                                  <td class="table-td ">
                                    <div>
                                      $3671.81
                                    </div>
                                  </td>
                                  <td class="table-td ">

                                    <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-danger-500
                              bg-danger-500">
                                      cancled
                                    </div>

                                  </td>
                                  <td class="table-td ">
                                    <div>
                                      <div class="relative">
                                        <div class="dropdown relative">
                                          <button class="text-xl text-center block w-full " type="button" id="tableDropdownMenuButton13" data-bs-toggle="dropdown" aria-expanded="false">
                                            <iconify-icon icon="heroicons-outline:dots-vertical"></iconify-icon>
                                          </button>
                                          <ul class=" dropdown-menu min-w-[120px] absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700
                                  shadow z-[2] float-left overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">
                                  <li>
                                              <a href="invoive-preview.html" class=" hover:bg-slate-900 hover:text-white dark:hover:bg-slate-600 dark:hover:bg-opacity-50 w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:eye"></iconify-icon>
                                    </span>
                                                <span class="text-sm">View</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="invoive-preview.html" class=" hover:bg-slate-900 hover:text-white dark:hover:bg-slate-600 dark:hover:bg-opacity-50 w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                    </span>
                                                <span class="text-sm">Edit</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="#" class=" bg-danger-500 text-danger-500 bg-opacity-30 hover:bg-opacity-100 hover:text-white w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer last:rounded-b flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:trash"></iconify-icon>
                                    </span>
                                                <span class="text-sm">Delete</span>
                                              </a>
                                            </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                </tr>

                                <tr>
                                  <td class="table-td">14</td>
                                  <td class="table-td ">#374</td>
                                  <td class="table-td">
                                    <span class="flex">
                          <span class="w-7 h-7 rounded-full ltr:mr-3 rtl:ml-3 flex-none">
                            <img src="backend/images/all-img/customer_1.png" alt="14" class="object-cover w-full h-full rounded-full">
                          </span>
                                    <span class="text-sm text-slate-600 dark:text-slate-300 capitalize">Jenny Wilson</span>
                                    </span>
                                  </td>
                                  <td class="table-td ">2/10/2022</td>
                                  <td class="table-td ">
                                    <div>
                                      2
                                    </div>
                                  </td>
                                  <td class="table-td ">
                                    <div>
                                      $3401.82
                                    </div>
                                  </td>
                                  <td class="table-td ">

                                    <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-success-500
                              bg-success-500">
                                      paid
                                    </div>

                                  </td>
                                  <td class="table-td ">
                                    <div>
                                      <div class="relative">
                                        <div class="dropdown relative">
                                          <button class="text-xl text-center block w-full " type="button" id="tableDropdownMenuButton14" data-bs-toggle="dropdown" aria-expanded="false">
                                            <iconify-icon icon="heroicons-outline:dots-vertical"></iconify-icon>
                                          </button>
                                          <ul class=" dropdown-menu min-w-[120px] absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700
                                  shadow z-[2] float-left overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">
                                           
                                  <li>
                                              <a href="invoive-preview.html" class=" hover:bg-slate-900 hover:text-white dark:hover:bg-slate-600 dark:hover:bg-opacity-50 w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:eye"></iconify-icon>
                                    </span>
                                                <span class="text-sm">View</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="invoive-preview.html" class=" hover:bg-slate-900 hover:text-white dark:hover:bg-slate-600 dark:hover:bg-opacity-50 w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                    </span>
                                                <span class="text-sm">Edit</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="#" class=" bg-danger-500 text-danger-500 bg-opacity-30 hover:bg-opacity-100 hover:text-white w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer last:rounded-b flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:trash"></iconify-icon>
                                    </span>
                                                <span class="text-sm">Delete</span>
                                              </a>
                                            </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                </tr>

                                <tr>
                                  <td class="table-td">15</td>
                                  <td class="table-td ">#32</td>
                                  <td class="table-td">
                                    <span class="flex">
                          <span class="w-7 h-7 rounded-full ltr:mr-3 rtl:ml-3 flex-none">
                            <img src="backend/images/all-img/customer_1.png" alt="15" class="object-cover w-full h-full rounded-full">
                          </span>
                                    <span class="text-sm text-slate-600 dark:text-slate-300 capitalize">Jenny Wilson</span>
                                    </span>
                                  </td>
                                  <td class="table-td ">5/20/2022</td>
                                  <td class="table-td ">
                                    <div>
                                      4
                                    </div>
                                  </td>
                                  <td class="table-td ">
                                    <div>
                                      $2387.49
                                    </div>
                                  </td>
                                  <td class="table-td ">

                                    <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-danger-500
                              bg-danger-500">
                                      cancled
                                    </div>

                                  </td>
                                  <td class="table-td ">
                                    <div>
                                      <div class="relative">
                                        <div class="dropdown relative">
                                          <button class="text-xl text-center block w-full " type="button" id="tableDropdownMenuButton15" data-bs-toggle="dropdown" aria-expanded="false">
                                            <iconify-icon icon="heroicons-outline:dots-vertical"></iconify-icon>
                                          </button>
                                          <ul class=" dropdown-menu min-w-[120px] absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700
                                  shadow z-[2] float-left overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">
                                  <li>
                                              <a href="invoive-preview.html" class=" hover:bg-slate-900 hover:text-white dark:hover:bg-slate-600 dark:hover:bg-opacity-50 w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:eye"></iconify-icon>
                                    </span>
                                                <span class="text-sm">View</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="invoive-preview.html" class=" hover:bg-slate-900 hover:text-white dark:hover:bg-slate-600 dark:hover:bg-opacity-50 w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                    </span>
                                                <span class="text-sm">Edit</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="#" class=" bg-danger-500 text-danger-500 bg-opacity-30 hover:bg-opacity-100 hover:text-white w-full border-b
                                      border-b-gray-500 border-opacity-10 px-4 py-2 text-sm last:mb-0 cursor-pointer last:rounded-b flex space-x-2 items-center
                                      rtl:space-x-reverse ">
                                                <span class="text-base">
                                      <iconify-icon icon="heroicons:trash"></iconify-icon>
                                    </span>
                                                <span class="text-sm">Delete</span>
                                              </a>
                                            </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                </tr>

                            </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>


            </div>
        </div>
    </div>
</div>
@endsection