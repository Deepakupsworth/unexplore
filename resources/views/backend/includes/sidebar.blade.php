 <!-- BEGIN: Sidebar -->
 <!-- BEGIN: Sidebar -->
 <div class="sidebar-wrapper group">
     <div id="bodyOverlay" class="w-screen h-screen fixed top-0 bg-slate-900 bg-opacity-50 backdrop-blur-sm z-10 hidden">
     </div>
     <div class="logo-segment">
         <a class="flex items-center" href="{{ url('/admin/dashboard') }}">
             <img src="{{ asset('backend/images/logo/Unxplord-Saudi.png') }}" class="black_logo w-16 h-16" alt="logo">
             <img src="{{ asset('backend/images/logo/Unxplord-Saudi.png') }}" class="white_logo w-16 h-16"
                 alt="logo">
             <!-- <span class="ltr:ml-3 rtl:mr-3 text-xl font-Inter font-bold text-slate-900 dark:text-white">DashCode</span> -->
         </a>
         <!-- Sidebar Type Button -->
         <div id="sidebar_type" class="cursor-pointer text-slate-900 dark:text-white text-lg">
             <span class="sidebarDotIcon extend-icon cursor-pointer text-slate-900 dark:text-white text-2xl">
                 <div
                     class="h-4 w-4 border-[1.5px] border-slate-900 dark:border-slate-700 rounded-full transition-all duration-150 ring-2 ring-inset ring-offset-4 ring-black-900 dark:ring-slate-400 bg-slate-900 dark:bg-slate-400 dark:ring-offset-slate-700">
                 </div>
             </span>
             <span class="sidebarDotIcon collapsed-icon cursor-pointer text-slate-900 dark:text-white text-2xl">
                 <div
                     class="h-4 w-4 border-[1.5px] border-slate-900 dark:border-slate-700 rounded-full transition-all duration-150">
                 </div>
             </span>
         </div>
         <button class="sidebarCloseIcon text-2xl">
             <iconify-icon class="text-slate-900 dark:text-slate-200" icon="clarity:window-close-line"></iconify-icon>
         </button>
     </div>
     <div id="nav_shadow"
         class="nav_shadow h-[60px] absolute top-[80px] nav-shadow z-[1] w-full transition-all duration-200 pointer-events-none
      opacity-0">
     </div>
     <div class="sidebar-menus bg-white dark:bg-slate-800 py-2 px-4 h-[calc(100%-80px)] overflow-y-auto z-50"
         id="sidebar_menus">
         {{-- <ul class="sidebar-menu">
             <li class="sidebar-menu-title">MENU</li>

             <li>
                 <a href="{{ url('/admin/dashboard') }}" class="navItem">
                     <span class="flex items-center">
                         <iconify-icon class="nav-icon" icon="heroicons-outline:home"></iconify-icon>
                         <span>Dashboard</span>
                     </span>
                 </a>
             </li>

             <!-- Apps -->
             <li class="sidebar-menu-title">APPS</li>

             <li>
                 <a href="{{ url('/admin/categories') }}" class="navItem">
                     <span class="flex items-center">
                         <iconify-icon class="nav-icon" icon="heroicons-outline:view-grid"></iconify-icon>
                         <span>Categories</span>
                     </span>
                 </a>
             </li>

             <li>
                 <a href="{{ url('/admin/countries') }}" class="navItem">
                     <span class="flex items-center">
                         <iconify-icon class="nav-icon" icon="heroicons-outline:globe-alt"></iconify-icon>
                         <span>Countries</span>
                     </span>
                 </a>
             </li>

             <li>
                 <a href="{{ url('/admin/cities') }}" class="navItem">
                     <span class="flex items-center">
                         <iconify-icon class="nav-icon" icon="heroicons-outline:map"></iconify-icon>
                         <span>Cities</span>
                     </span>
                 </a>
             </li>

             <li>
                 <a href="{{ url('/admin/hotels') }}" class="navItem">
                     <span class="flex items-center">
                         <iconify-icon class="nav-icon" icon="heroicons-outline:office-building"></iconify-icon>
                         <span>Hotels</span>
                     </span>
                 </a>
             </li>

             <li>
                 <a href="{{ url('/admin/transports') }}" class="navItem">
                     <span class="flex items-center">
                         <iconify-icon class="nav-icon" icon="heroicons-outline:truck"></iconify-icon>
                         <span>Transports</span>
                     </span>
                 </a>
             </li>

             <li>
                 <a href="{{ url('/admin/thingtodo') }}" class="navItem">
                     <span class="flex items-center">
                         <iconify-icon class="nav-icon" icon="heroicons-outline:clipboard-list"></iconify-icon>
                         <span>Things To Do</span>
                     </span>
                 </a>
             </li>

             <li>
                 <a href="{{ url('/admin/events') }}" class="navItem">
                     <span class="flex items-center">
                         <iconify-icon class="nav-icon" icon="heroicons-outline:calendar"></iconify-icon>
                         <span>Events</span>
                     </span>
                 </a>
             </li>

             <!-- Settings -->
             <li class="sidebar-menu-title">SETTINGS</li>

             <li>
                 <a href="{{ url('/admin/languages') }}" class="navItem">
                     <span class="flex items-center">
                         <iconify-icon class="nav-icon" icon="heroicons-outline:language"></iconify-icon>
                         <span>Languages</span>
                     </span>
                 </a>
             </li>
         </ul> --}}

         <ul class="sidebar-menu">
            <li class="sidebar-menu-title">MENU</li>

            <li>
                <x-sidebar-link href="{{ url('/admin/dashboard') }}">
                    <span class="flex items-center">
                        <iconify-icon class="nav-icon" icon="heroicons-outline:home"></iconify-icon>
                        <span>Dashboard</span>
                    </span>
                </x-sidebar-link>
            </li>

            <li class="sidebar-menu-title">APPS</li>

            <li>
                <x-sidebar-link href="{{ url('/admin/categories') }}">
                    <span class="flex items-center">
                        <iconify-icon class="nav-icon" icon="heroicons-outline:view-grid"></iconify-icon>
                        <span>Categories</span>
                    </span>
                </x-sidebar-link>
            </li>

            <li>
                <x-sidebar-link href="{{ url('/admin/countries') }}">
                    <span class="flex items-center">
                        <iconify-icon class="nav-icon" icon="heroicons-outline:globe-alt"></iconify-icon>
                        <span>Countries</span>
                    </span>
                </x-sidebar-link>
            </li>

            <li>
                <x-sidebar-link href="{{ url('/admin/cities') }}">
                    <span class="flex items-center">
                        <iconify-icon class="nav-icon" icon="heroicons-outline:map"></iconify-icon>
                        <span>Cities</span>
                    </span>
                </x-sidebar-link>
            </li>

            <li>
                <x-sidebar-link href="{{ url('/admin/hotels') }}">
                    <span class="flex items-center">
                        <iconify-icon class="nav-icon" icon="heroicons-outline:office-building"></iconify-icon>
                        <span>Hotels</span>
                    </span>
                </x-sidebar-link>
            </li>

            <li>
                <x-sidebar-link href="{{ url('/admin/transports') }}">
                    <span class="flex items-center">
                        <iconify-icon class="nav-icon" icon="heroicons-outline:truck"></iconify-icon>
                        <span>Transports</span>
                    </span>
                </x-sidebar-link>
            </li>

            <li>
                <x-sidebar-link href="{{ url('/admin/thingtodo') }}">
                    <span class="flex items-center">
                        <iconify-icon class="nav-icon" icon="heroicons-outline:clipboard-list"></iconify-icon>
                        <span>Things To Do</span>
                    </span>
                </x-sidebar-link>
            </li>

            <li>
                <x-sidebar-link href="{{ url('/admin/events') }}">
                    <span class="flex items-center">
                        <iconify-icon class="nav-icon" icon="heroicons-outline:calendar"></iconify-icon>
                        <span>Events</span>
                    </span>
                </x-sidebar-link>
            </li>

            <li class="sidebar-menu-title">SETTINGS</li>

            <li>
                <x-sidebar-link href="{{ url('/admin/languages') }}">
                    <span class="flex items-center">
                        <iconify-icon class="nav-icon" icon="heroicons-outline:language"></iconify-icon>
                        <span>Languages</span>
                    </span>
                </x-sidebar-link>
            </li>
        </ul>


     </div>
 </div>
 <!-- End: Sidebar -->
 <!-- End: Sidebar -->
 <!-- BEGIN: Settings -->

 <!-- BEGIN: Settings -->
 <!-- Settings Toggle Button -->
 <button
     class="fixed ltr:md:right-[-29px] ltr:right-0 rtl:left-0 rtl:md:left-[-29px] top-1/2 z-[888] translate-y-1/2 bg-slate-800 text-slate-50 dark:bg-slate-700 dark:text-slate-300 cursor-pointer transform rotate-90 flex items-center text-sm font-medium px-2 py-2 shadow-deep ltr:rounded-b rtl:rounded-t"
     data-bs-toggle="offcanvas" data-bs-target="#offcanvas" aria-controls="offcanvas">
     <iconify-icon class="text-slate-50 text-lg animate-spin"
         icon="material-symbols:settings-outline-rounded"></iconify-icon>
     <span class="hidden md:inline-block ltr:ml-2 rtl:mr-2">Settings</span>
 </button>

 <!-- BEGIN: Settings Modal -->
 <div class="offcanvas offcanvas-end fixed bottom-0 flex flex-col max-w-full bg-white dark:bg-slate-800 invisible bg-clip-padding shadow-sm outline-none transition duration-300 ease-in-out text-gray-700 top-0 ltr:right-0 rtl:left-0 border-none w-96"
     tabindex="-1" id="offcanvas" aria-labelledby="offcanvas">
     <div class="offcanvas-header flex items-center justify-between p-4 pt-3 border-b border-b-slate-300">
         <div>
             <h3 class="block text-xl font-Inter text-slate-900 font-medium dark:text-[#eee]">
                 Theme customizer
             </h3>
             <p class="block text-sm font-Inter font-light text-[#68768A] dark:text-[#eee]">Customize & Preview in Real
                 Time</p>
         </div>
         <button type="button"
             class="box-content text-2xl w-4 h-4 p-2 pt-0 -my-5 -mr-2 text-black dark:text-white border-none rounded-none opacity-100 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
             data-bs-dismiss="offcanvas"><iconify-icon icon="line-md:close"></iconify-icon></button>
     </div>
     <div class="offcanvas-body flex-grow overflow-y-auto">
         <div class="settings-modal">
             <div class="p-6">

                 <h3 class="mt-4">Theme</h3>
                 <form class="input-area flex items-center space-x-8 rtl:space-x-reverse" id="themeChanger">
                     <div class="input-group flex items-center">
                         <input type="radio" id="light" name="theme" value="light"
                             class="themeCustomization-checkInput">
                         <label for="light" class="themeCustomization-checkInput-label">Light</label>
                     </div>
                     <div class="input-group flex items-center">
                         <input type="radio" id="dark" name="theme" value="dark"
                             class="themeCustomization-checkInput">
                         <label for="dark" class="themeCustomization-checkInput-label">Dark</label>
                     </div>
                     <div class="input-group flex items-center">
                         <input type="radio" id="semiDark" name="theme" value="semiDark"
                             class="themeCustomization-checkInput">
                         <label for="semiDark" class="themeCustomization-checkInput-label">Semi Dark</label>
                     </div>
                 </form>
             </div>
             <div class="divider"></div>
             <div class="p-6">

                 <div class="flex items-center justify-between mt-5">
                     <h3 class="!mb-0">Rtl</h3>
                     <label id="rtl_ltr"
                         class="relative inline-flex h-6 w-[46px] items-center rounded-full transition-all duration-150 cursor-pointer">
                         <input type="checkbox" value="" class="sr-only peer">
                         <span
                             class="w-11 h-6 bg-gray-200 peer-focus:outline-none ring-0 rounded-full peer dark:bg-gray-900 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-black-600"></span>
                     </label>
                 </div>
             </div>
             <div class="divider"></div>
             <div class="p-6">
                 <h3>Content Width</h3>
                 <div class="input-area flex items-center space-x-8 rtl:space-x-reverse">
                     <div class="input-group flex items-center">
                         <input type="radio" id="fullWidth" name="content-width" value="fullWidth"
                             class="themeCustomization-checkInput">
                         <label for="fullWidth" class="themeCustomization-checkInput-label ">Full Width</label>
                     </div>
                     <div class="input-group flex items-center">
                         <input type="radio" id="boxed" name="content-width" value="boxed"
                             class="themeCustomization-checkInput">
                         <label for="boxed" class="themeCustomization-checkInput-label ">Boxed</label>
                     </div>
                 </div>
                 <h3 class="mt-4">Menu Layout</h3>
                 <div class="input-area flex items-center space-x-8 rtl:space-x-reverse">
                     <div class="input-group flex items-center">
                         <input type="radio" id="vertical_menu" name="menu_layout" value="vertical"
                             class="themeCustomization-checkInput">
                         <label for="vertical_menu" class="themeCustomization-checkInput-label ">Vertical</label>
                     </div>
                     <div class="input-group flex items-center">
                         <input type="radio" id="horizontal_menu" name="menu_layout" value="horizontal"
                             class="themeCustomization-checkInput">
                         <label for="horizontal_menu" class="themeCustomization-checkInput-label ">Horizontal</label>
                     </div>
                 </div>
                 <div id="menuCollapse" class="flex items-center justify-between mt-5">
                     <h3 class="!mb-0">Menu Collapsed</h3>
                     <label
                         class="relative inline-flex h-6 w-[46px] items-center rounded-full transition-all duration-150 cursor-pointer">
                         <input type="checkbox" value="" class="sr-only peer">
                         <span
                             class="w-11 h-6 bg-gray-200 peer-focus:outline-none ring-0 rounded-full peer dark:bg-gray-900 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-black-500"></span>
                     </label>
                 </div>
                 <div id="menuHidden" class="!flex items-center justify-between mt-5">
                     <h3 class="!mb-0">Menu Hidden</h3>
                     <label id="menuHide"
                         class="relative inline-flex h-6 w-[46px] items-center rounded-full transition-all duration-150 cursor-pointer">
                         <input type="checkbox" value="" class="sr-only peer">
                         <span
                             class="w-11 h-6 bg-gray-200 peer-focus:outline-none ring-0 rounded-full peer dark:bg-gray-900 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-black-500"></span>
                     </label>
                 </div>
             </div>
             <div class="divider"></div>
             <div class="p-6">
                 <h3>Navbar Type</h3>
                 <div class="input-area flex flex-wrap items-center space-x-4 rtl:space-x-reverse">
                     <div class="input-group flex items-center">
                         <input type="radio" id="nav_floating" name="navbarType" value="floating"
                             class="themeCustomization-checkInput">
                         <label for="nav_floating" class="themeCustomization-checkInput-label ">Floating</label>
                     </div>
                     <div class="input-group flex items-center">
                         <input type="radio" id="nav_sticky" name="navbarType" value="sticky"
                             class="themeCustomization-checkInput">
                         <label for="nav_sticky" class="themeCustomization-checkInput-label ">Sticky</label>
                     </div>
                     <div class="input-group flex items-center">
                         <input type="radio" id="nav_static" name="navbarType" value="static"
                             class="themeCustomization-checkInput">
                         <label for="nav_static" class="themeCustomization-checkInput-label ">Static</label>
                     </div>
                     <div class="input-group flex items-center">
                         <input type="radio" id="nav_hidden" name="navbarType" value="hidden"
                             class="themeCustomization-checkInput">
                         <label for="nav_hidden" class="themeCustomization-checkInput-label ">Hidden</label>
                     </div>
                 </div>
                 <h3 class="mt-4">Footer Type</h3>
                 <div class="input-area flex items-center space-x-4 rtl:space-x-reverse">
                     <div class="input-group flex items-center">
                         <input type="radio" id="footer_sticky" name="footerType" value="sticky"
                             class="themeCustomization-checkInput">
                         <label for="footer_sticky" class="themeCustomization-checkInput-label ">Sticky</label>
                     </div>
                     <div class="input-group flex items-center">
                         <input type="radio" id="footer_static" name="footerType" value="static"
                             class="themeCustomization-checkInput">
                         <label for="footer_static" class="themeCustomization-checkInput-label ">Static</label>
                     </div>
                     <div class="input-group flex items-center">
                         <input type="radio" id="footer_hidden" name="footerType" value="hidden"
                             class="themeCustomization-checkInput">
                         <label for="footer_hidden" class="themeCustomization-checkInput-label ">Hidden</label>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- END: Settings Modal -->
 <!-- END: Settings -->

 <!-- End: Settings -->
