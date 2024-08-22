<div class="iq-sidebar  sidebar-default  ">
    <div class="iq-sidebar-logo d-flex align-items-end justify-content-between">
        <a href="../backend/index.html" class="header-logo">
            <img src="{{ asset('templates/datum/images/logo.png') }}" class="img-fluid rounded-normal light-logo"
                alt="logo">
            <img src="{{ asset('templates/datum/images/logo-dark.png') }}"
                class="img-fluid rounded-normal d-none sidebar-light-img" alt="logo">
            <span>Budget Buddy</span>
        </a>
        <div class="side-menu-bt-sidebar-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="text-light wrapper-menu" width="30" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>
    </div>
    <div class="data-scrollbar" data-scroll="1">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="side-menu">
                <li class="sidebar-layout {{ (request()->is('dashboard*') || request()->is('account/*')) ? 'active' : '' }}">
                    <a href="{{route('dashboard.index')}}" class="svg-icon">
                        <i class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </i>
                        <span class="ml-2">Dashboard</span>
                        {{-- <p class="mb-0 w-10 badge badge-pill badge-primary">6</p> --}}
                    </a>
                </li>
                {{-- <li class="px-3 pt-3 pb-2">
                    <span class="text-uppercase small font-weight-bold">Pages</span>
                </li> --}}
                <li class="sidebar-layout {{request()->is('category-management*') ? 'active' : ''}}">
                    <a href="{{route('category_management.list')}}" class="svg-icon">
                        <i class="">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                            </svg>                              
                        </i><span class="ml-2">Category Management</span>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="pt-5 pb-5"></div>
    </div>
</div>
