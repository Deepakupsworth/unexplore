 <!-- BEGIN: Sidebar -->
    <!-- BEGIN: Sidebar -->
    <div class="sidebar-wrapper group">
      <div id="bodyOverlay"
        class="w-screen h-screen fixed top-0 bg-slate-900 bg-opacity-50 backdrop-blur-sm z-10 hidden"></div>
      <div class="logo-segment">
        <a class="flex items-center" href="index.html">
          <img src="/images/logo/logo-c.svg" class="black_logo" alt="logo">
          <img src="/images/logo/logo-c-white.svg" class="white_logo" alt="logo">
          <span class="ltr:ml-3 rtl:mr-3 text-xl font-Inter font-bold text-slate-900 dark:text-white">DashCode</span>
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
      <div id="nav_shadow" class="nav_shadow h-[60px] absolute top-[80px] nav-shadow z-[1] w-full transition-all duration-200 pointer-events-none
      opacity-0"></div>
      <div class="sidebar-menus bg-white dark:bg-slate-800 py-2 px-4 h-[calc(100%-80px)] overflow-y-auto z-50"
        id="sidebar_menus">
        <ul class="sidebar-menu">
          <li class="sidebar-menu-title">MENU</li>
          <li class="">
            <a href="#" class="navItem">
              <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:home"></iconify-icon>
                <span>Dashboard</span>
              </span>
              <iconify-icon class="icon-arrow" icon="heroicons-outline:chevron-right"></iconify-icon>
            </a>
            <ul class="sidebar-submenu">
              <li>
                <a href="index.html">Analytics Dashboard</a>
              </li>
              <li>
                <a href="ecommerce-dashboard.html">Ecommerce Dashboard
                </a>
              </li>
              <li>
                <a href="project-dashboard.html">Project Dashboard
                </a>
              </li>
              <li>
                <a href="crm-dashboard.html">CRM Dashboard
                </a>
              </li>
              <li>
                <a href="banking-dashboard.html">Banking Dashboard
                </a>
              </li>
            </ul>
          </li>
          <!-- Apps Area -->
          <li class="sidebar-menu-title">APPS</li>
          <li>
            <a href="chat.html" class="navItem">
              <span class="flex items-center">
                <iconify-icon class="nav-icon" icon="heroicons-outline:chat"></iconify-icon>
                <span>Chat</span>
              </span>
            </a>
          </li>
          <li class="">
            <a href="email.html" class="navItem">
              <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:mail"></iconify-icon>
                <span>Email</span>
              </span>
            </a>
          </li>
          <li class="">
            <a href="kanban.html" class="navItem">
              <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:view-boards"></iconify-icon>
                <span>Kanban</span>
              </span>
            </a>
          </li>
          <li class="">
            <a href="calander.html" class="navItem">
              <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:calendar"></iconify-icon>
                <span>Calander</span>
              </span>
            </a>
          </li>
          <li class="">
            <a href="todo.html" class="navItem">
              <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:clipboard-check"></iconify-icon>
                <span>Todo</span>
              </span>
            </a>
          </li>
          <li class="">
            <a href="javascript:void(0)" class="navItem">
              <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:document"></iconify-icon>
                <span>Projects</span>
              </span>
              <iconify-icon class="icon-arrow" icon="heroicons-outline:chevron-right"></iconify-icon>
            </a>
            <ul class="sidebar-submenu">
              <li>
                <a href="project.html">Projects</a>
              </li>
              <li>
                <a href="project-details.html">Project Details</a>
              </li>
            </ul>
          </li>
          <!-- Pages Area -->
          <li class="sidebar-menu-title">PAGES</li>
          <!-- Authentication -->
          <li class="">
            <a href="javascript:void(0)" class="navItem">
              <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:lock-closed"></iconify-icon>
                <span>Authentication</span>
              </span>
              <iconify-icon class="icon-arrow" icon="heroicons-outline:chevron-right"></iconify-icon>
            </a>
            <ul class="sidebar-submenu">
              <li>
                <a href="signin-one.html">Signin One</a>
              </li>
              <li>
                <a href="signin-two.html">Signin Two</a>
              </li>
              <li>
                <a href="signin-three.html">Signin Three</a>
              </li>
              <li>
                <a href="signup-one.html">Signup One</a>
              </li>
              <li>
                <a href="signup-two.html">Signup Two</a>
              </li>
              <li>
                <a href="signup-three.html">Signup Three</a>
              </li>
              <li>
                <a href="forget-password-one.html">Forget Password One</a>
              </li>
              <li>
                <a href="forget-password-two.html">Forget Password Two</a>
              </li>
              <li>
                <a href="forget-password-three.html">Forget Password Three</a>
              </li>
              <li>
                <a href="lock-screen-one.html">Lock Screen One</a>
              </li>
              <li>
                <a href="lock-screen-two.html">Lock Screen Two</a>
              </li>
              <li>
                <a href="lock-screen-three.html">Lock Screen Three</a>
              </li>
            </ul>
          </li>
          <!-- Utility -->
          <li class="">
            <a href="javascript:void(0)" class="navItem">
              <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:view-boards"></iconify-icon>
                <span>Utility</span>
              </span>
              <iconify-icon class="icon-arrow" icon="heroicons-outline:chevron-right"></iconify-icon>
            </a>
            <ul class="sidebar-submenu">
              <li>
                <a href="invoice.html">Invoice</a>
              </li>
              <li>
                <a href="pricing.html">Pricing</a>
              </li>
              <li>
                <a href="blog.html">Blog</a>
              </li>
              <li>
                <a href="blank-page.html">Blank Page</a>
              </li>
              <li>
                <a href="settings.html">Settings</a>
              </li>
              <li>
                <a href="profile.html">Profile</a>
              </li>
              <li>
                <a href="404.html">404 Page</a>
              </li>
              <li>
                <a href="comming-soon.html">Coming Soon</a>
              </li>
              <li>
                <a href="under-maintanance.html">Under Maintanance</a>
              </li>
            </ul>
          </li>
          <!-- Elements Area -->
          <li class="sidebar-menu-title">ELEMENTS</li>
          <!-- Widgets -->
          <li class="">
            <a href="javascript:void(0)" class="navItem">
              <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:view-grid-add"></iconify-icon>
                <span>Widgets</span>
              </span>
              <iconify-icon class="icon-arrow" icon="heroicons-outline:chevron-right"></iconify-icon>
            </a>
            <ul class="sidebar-submenu">
              <li>
                <a href="basic-widgets.html">Basic</a>
              </li>
              <li>
                <a href="statistics-widgets.html">Statistic</a>
              </li>
            </ul>
          </li>
          <!-- Components -->
          <li>
            <a href="javascript:void(0)" class="navItem">
              <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:collection"></iconify-icon>
                <span>Components</span>
              </span>
              <iconify-icon class="icon-arrow" icon="heroicons-outline:chevron-right"></iconify-icon>
            </a>
            <ul class="sidebar-submenu">
              <li>
                <a href="typography.html">Typography</a>
              </li>
              <li>
                <a href="colors.html">Colors</a>
              </li>
              <li>
                <a href="alert.html">Alert</a>
              </li>
              <li>
                <a href="buttons.html">Button</a>
              </li>
              <li>
                <a href="card.html">Card</a>
              </li>
              <li>
                <a href="carousel.html">Carousel</a>
              </li>
              <li>
                <a href="dropdown.html">Dropdown</a>
              </li>
              <li>
                <a href="image.html">Image</a>
              </li>
              <li>
                <a href="modal.html">Modal</a>
              </li>
              <li>
                <a href="progressbar.html">Progress bar</a>
              </li>
              <li>
                <a href="placeholder.html">Placeholder</a>
              </li>
              <li>
                <a href="tab-accordion.html">Tab & Accordion</a>
              </li>
              <li>
                <a href="badges.html">Badges</a>
              </li>
              <li>
                <a href="pagination.html">Pagination</a>
              </li>
              <li>
                <a href="video.html">Video</a>
              </li>
              <li>
                <a href="tooltip-popover.html">Tooltip & Popover</a>
              </li>
            </ul>
          </li>
          <!-- Forms -->
          <li class="">
            <a href="javascript:void(0)" class="navItem">
              <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:clipboard-list"></iconify-icon>
                <span>Forms</span>
              </span>
              <iconify-icon class="icon-arrow" icon="heroicons-outline:chevron-right"></iconify-icon>
            </a>
            <ul class="sidebar-submenu">
              <li>
                <a href="input.html">Input</a>
              </li>
              <li>
                <a href="input-group.html">Input group</a>
              </li>
              <li>
                <a href="input-layout.html">Input layout</a>
              </li>
              <li>
                <a href="form-validation.html">Form validation</a>
              </li>
              <li>
                <a href="wizard.html">Wizard</a>
              </li>
              <li>
                <a href="input-mask.html">Input mask</a>
              </li>
              <li>
                <a href="file-input.html">File input</a>
              </li>
              <li>
                <a href="form-repeater.html">Form repeater</a>
              </li>
              <li>
                <a href="textarea.html">Textarea</a>
              </li>
              <li>
                <a href="checkbox.html">Checkbox</a>
              </li>
              <li>
                <a href="radio.html">Radio button</a>
              </li>
              <li>
                <a href="switch.html">Switch</a>
              </li>
              <li>
                <a href="select.html">Select</a>
              </li>
              <li>
                <a href="date-picker.html">Date time picker</a>
              </li>
            </ul>
          </li>
          <!-- Tables -->
          <li class="">
            <a href="javascript:void(0)" class="navItem">
              <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:table"></iconify-icon>
                <span>Tables</span>
              </span>
              <iconify-icon class="icon-arrow" icon="heroicons-outline:chevron-right"></iconify-icon>
            </a>
            <ul class="sidebar-submenu">
              <li>
                <a href="basic-table.html">Basic table</a>
              </li>
              <li>
                <a href="advance-table.html">Advanced table</a>
              </li>
            </ul>
          </li>
          <!-- Charts -->
          <li class="">
            <a href="javascript:void(0)" class="navItem">
              <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:chart-bar"></iconify-icon>
                <span>Chart</span>
              </span>
              <iconify-icon class="icon-arrow" icon="heroicons-outline:chevron-right"></iconify-icon>
            </a>
            <ul class="sidebar-submenu">
              <li>
                <a href="apex-chart.html">Apex chart</a>
              </li>
              <li>
                <a href="chartjs.html">Chart js</a>
              </li>
            </ul>
          </li>
          <!-- Map -->
          <li class="">
            <a href="map.html" class="navItem">
              <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:map"></iconify-icon>
                <span>Map</span>
              </span>
            </a>
          </li>
          <!-- Icons -->
          <li class="">
            <a href="icons.html" class="navItem">
              <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:emoji-happy"></iconify-icon>
                <span>Icons</span>
              </span>
            </a>
          </li>
        </ul>
        <!-- Upgrade Your Business Plan Card Start -->
        <div class="bg-slate-900 mb-10 mt-24 p-4 relative text-center rounded-2xl text-white"
          id="sidebar_bottom_wizard">
          <img src="/images/svg/rabit.svg" alt="" class="mx-auto relative -mt-[73px]">
          <div class="max-w-[160px] mx-auto mt-6">
            <div class="widget-title font-Inter mb-1">Unlimited Access</div>
            <div class="text-xs font-light font-Inter">
              Upgrade your system to business plan
            </div>
          </div>
          <div class="mt-6">
            <button
              class="bg-white hover:bg-opacity-80 text-slate-900 text-sm font-Inter rounded-md w-full block py-2 font-medium">
              Upgrade
            </button>
          </div>
        </div>
        <!-- Upgrade Your Business Plan Card Start -->
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
    <div
      class="offcanvas offcanvas-end fixed bottom-0 flex flex-col max-w-full bg-white dark:bg-slate-800 invisible bg-clip-padding shadow-sm outline-none transition duration-300 ease-in-out text-gray-700 top-0 ltr:right-0 rtl:left-0 border-none w-96"
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
                <input type="radio" id="light" name="theme" value="light" class="themeCustomization-checkInput">
                <label for="light" class="themeCustomization-checkInput-label">Light</label>
              </div>
              <div class="input-group flex items-center">
                <input type="radio" id="dark" name="theme" value="dark" class="themeCustomization-checkInput">
                <label for="dark" class="themeCustomization-checkInput-label">Dark</label>
              </div>
              <div class="input-group flex items-center">
                <input type="radio" id="semiDark" name="theme" value="semiDark" class="themeCustomization-checkInput">
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
                <input type="radio" id="boxed" name="content-width" value="boxed" class="themeCustomization-checkInput">
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
