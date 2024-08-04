<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">

        <!-- Dark Logo-->
        <a href="{{ route('publishers.dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="22">


            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" height="17">

            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
               @auth
                   @if(Auth::user()->role == 'advertiser')
                   <h2 class="text-white mt-3">Advertiser</h2>
                   @elseif (Auth::user()->role == 'publisher')
                   <h2 class="text-white mt-3">Publisher</h2>

                   @endif
               @endauth
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>@lang('translation.menu')</span></li>

                @auth
                    @if (Auth::user()->role == 'publisher')
                        <!-- Publisher Menu Items -->
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('publishers.dashboard') ? 'active' : '' }}"
                                href="{{ route('publishers.dashboard') }}">
                                <i class="fa fa-home" aria-hidden="true"></i>  <span>Home</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('publishers.website') ? 'active' : '' }}"
                                href="{{ route('publishers.website') }}">
                                <i class="fa fa-list-alt" aria-hidden="true"></i><span>Website</span>
                            </a>
                        </li>
                        {{-- Sell --}}
                        <li class="nav-item">
                            <a class="nav-link menu-link"
                                href="">
                                <i class='bx bxs-analyse'></i><span>Sell</span>
                            </a>
                        </li>
                         {{-- Wallet --}}
                         <li class="nav-item">
                            <a class="nav-link menu-link"
                                href="">
                                <i class="fa fa-google-wallet" aria-hidden="true"></i><span>Wallet</span>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('publishers.ContactSupport') ? 'active' : '' }}"
                                href="{{ route('publishers.ContactSupport') }}">
                                <i class="fa fa-life-ring" aria-hidden="true"></i> <span>Contact Support</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('publishers.KYC') ? 'active' : '' }}"
                                href="{{ route('publishers.KYC') }}">
                                <i class="fa fa-yoast" aria-hidden="true"></i></i><span>KYC Application</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('publishers.ProfileSetting') ? 'active' : '' }}"
                                href="{{ route('publishers.ProfileSetting') }}">
                                <i class="fa fa-cog" aria-hidden="true"></i> <span>Profile Setting</span>
                            </a>
                        </li>

                          <!-- Membership Menu Item -->
                        {{-- <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('publishers.membership') ? 'active' : '' }}"
                                href="{{ route('publishers.membership') }}">
                                <i class="ri-honour-line"></i> <span>Membership</span>
                            </a>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('publishers.sponsored') ? 'active' : '' }}"
                                href="{{ route('publishers.sponsored') }}">
                                <i class="fa fa-certificate" aria-hidden="true"></i><span>Sponsored</span>
                            </a>
                        </li> --}}

                        <!-- Payments Menu Item ✨ -->
                        {{-- <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('publishers.transactions') || request()->routeIs('publishers.billing') ? 'active' : '' }}"
                                href="#Payments" data-bs-toggle="collapse" role="button" aria-expanded="false"
                                aria-controls="sidebarAdvanceUI">
                                <i class="ri-stack-line"></i> <span>Payments</span>
                            </a>
                            <div class="collapse menu-dropdown {{ request()->routeIs('publishers.transactions') || request()->routeIs('publishers.billing') ? 'show' : '' }}"
                                id="Payments">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('publishers.transactions') }}"
                                            class="nav-link {{ request()->routeIs('publishers.transactions') ? 'active' : '' }}">Transactions</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('publishers.billing') }}"
                                            class="nav-link {{ request()->routeIs('publishers.billing') ? 'active' : '' }}">Billing</a>
                                    </li>
                                </ul>
                            </div>
                        </li> --}}

                        <!-- NFT Marketplace Menu Item ✨ -->
                        {{-- <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('publishers.explore') ? 'active' : '' }}"
                                href="#NFT_Marketplace" data-bs-toggle="collapse" role="button" aria-expanded="false"
                                aria-controls="sidebarAdvanceUI">
                                <i class="ri-stack-line"></i> <span>NFT Marketplace</span>
                            </a>
                            <div class="collapse menu-dropdown {{ request()->routeIs('publishers.explore') ? 'show' : '' }}"
                                id="NFT_Marketplace">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('publishers.explore') }}"
                                            class="nav-link {{ request()->routeIs('publishers.explore') ? 'active' : '' }}">Explore now</a>
                                    </li>
                                </ul>
                            </div>
                        </li> --}}

                        <!-- Support Tickets Menu Item ✨ -->
                        {{-- <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('publishers.ticket.list') ? 'active' : '' }}"
                                href="#Support_Tickets" data-bs-toggle="collapse" role="button" aria-expanded="false"
                                aria-controls="sidebarAdvanceUI">
                                <i class="ri-stack-line"></i> <span>Support Tickets</span>
                            </a>
                            <div class="collapse menu-dropdown {{ request()->routeIs('publishers.ticket.list') ? 'show' : '' }}"
                                id="Support_Tickets">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('publishers.ticket.list') }}"
                                            class="nav-link {{ request()->routeIs('publishers.ticket.list') ? 'active' : '' }}">List View</a>
                                    </li>
                                </ul>
                            </div>
                        </li> --}}

                        <!-- Chat Menu Item ✨-->
                        {{-- <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('publishers.chat') ? 'active' : '' }}"
                                href="{{ route('publishers.chat') }}">
                                <i class="ri-honour-line"></i> <span>Chat</span>
                            </a>
                        </li> --}}
                    @elseif(Auth::user()->role == 'advertiser')
                        <!-- Advertiser Menu Items -->
                        {{-- Home --}}
                         <!-- Chat Menu Item ✨-->
                       
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('advertiser.dashboard') ? 'active' : '' }}"
                                href="{{ route('advertiser.dashboard') }}">
                                <i class="fa fa-home" aria-hidden="true"></i> <span>Home</span>
                            </a>
                        </li>
                        {{-- My Projects --}}
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('advertiser.project.list') ? 'active' : '' }}"
                                href="{{ route('advertiser.project.list') }}">
                                <i class="fa fa-list-ul" aria-hidden="true"></i><span>My Projects</span>
                            </a>
                        </li>
                        {{-- Websites --}}
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('advertiser.webs.list') ? 'active' : '' }}"
                                href="{{ route('advertiser.webs.list') }}">
                                <i class="fa fa-list-ul" aria-hidden="true"></i><span>Websites</span>
                            </a>
                        </li>
                        {{-- if need then uncomment 👇 --}}
                        {{-- Contact Support --}}
                        {{-- <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('advertiser.ContactSupport') ? 'active' : '' }}"
                                href="{{ route('advertiser.ContactSupport') }}">
                                <i class="fa fa-life-ring" aria-hidden="true"></i><span>Contact Support</span>
                            </a>
                        </li> --}}

                        <li class="nav-item">
                            <a class="nav-link menu-link "
                                href="">
                                <i class="fa fa-money" aria-hidden="true"></i><span>Purchase</span>
                            </a>
                        </li>
                        {{-- Wallet --}}
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('advertiser.wallet') ? 'active' : '' }}"
                                href="{{ route('advertiser.wallet') }}">
                                <i class="fa fa-google-wallet" aria-hidden="true"></i><span>Wallet</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('advertiser.KYC') ? 'active' : '' }}"
                                href="{{ route('advertiser.KYC') }}">
                                <i class="fa fa-yoast" aria-hidden="true"></i></i><span>KYC Application</span>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('advertiser.ProfileSetting') ? 'active' : '' }}"
                                href="{{ route('advertiser.ProfileSetting') }}">
                                <i class="fa fa-cog" aria-hidden="true"></i><span>Profile Setting</span>
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
