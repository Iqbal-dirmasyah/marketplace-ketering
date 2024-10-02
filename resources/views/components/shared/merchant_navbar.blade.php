<nav class="navbar bg-body-tertiary navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary d-block d-lg-none" href="{{ route('pages.merchant.dashboard') }}">Dashboard</a>
        <div class="navbar-nav justify-content-end pe-3 gap-2 d-none d-lg-flex">
            <li class="nav-item">
                <a class="nav-link fw-bold {{Route::is('pages.merchant.dashboard') ? 'text-primary' : 'text-body'}}" href="{{ route('pages.merchant.dashboard') }}">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-bold {{Route::is('pages.merchant.products') ? 'text-primary' : 'text-body'}}" href="{{ route('pages.merchant.products') }}">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-bold {{Route::is('pages.merchant.orders') ? 'text-primary' : 'text-body'}}" href="{{ route('pages.merchant.orders') }}">Orders</a>
            </li>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Marketplace</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3 gap-2">
                    <li class="nav-item d-block d-lg-none">
                        <a class="nav-link fw-bold" href="{{ route('pages.merchant.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item d-block d-lg-none">
                        <a class="nav-link fw-bold" href="{{ route('pages.merchant.products') }}">Products</a>
                    </li>
                    <li class="nav-item d-block d-lg-none">
                        <a class="nav-link fw-bold" href="{{ route('pages.merchant.orders') }}">Orders</a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <a href="#" id="topbarUserDropdown" class="user-dropdown d-flex align-items-center dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="avatar avatar-md2">
                                    <img src="{{ asset('images/person.png') }}" alt="Avatar">
                                </div>
                                <div class="text">
                                    <h6 class="user-dropdown-name">{{Auth::user()->name}}</h6>
                                    <p class="user-dropdown-status text-sm text-muted">Merchant</p>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="topbarUserDropdown" style="">
                              <li><a class="dropdown-item" href="{{ route('pages.merchant.profile') }}">Profile</a></li>
                              <li>
                                <form action="{{ route('pages.auth.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                              </li>
                            </ul>
                        </div>
                        <a class="nav-link" >
                           
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
