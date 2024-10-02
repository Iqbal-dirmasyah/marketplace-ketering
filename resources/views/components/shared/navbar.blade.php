<nav class="navbar bg-body-tertiary navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand text-primary fw-bold" href="{{ route('pages.home') }}">Marketplace - Katering</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Marketplace - Katering</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3 gap-2">
                    @auth
                        @if(Session::get('user')['role_id'] == 1)
                            <li class="nav-item">
                                <a class="nav-link fs-6 fw-semibold {{Route::is('pages.home') ? 'text-primary' : 'text-body'}}"
                                    href="{{ route('pages.merchant.dashboard')}}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fs-6 fw-semibold {{Route::is('pages.customer.products') || Route::currentRouteName() == 'pages.customer.products.show' ? 'text-primary' : 'text-body'}}"
                                    href="{{ route('pages.customer.products')}}">Produk</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fs-6 fw-semibold {{Route::is('pages.customer.transactions') ? 'text-primary' : 'text-body'}}"
                                    href="{{ route('pages.customer.transactions')}}">Transaksi</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('pages.customer.carts')}}" class="nav-link fs-6 fw-semibold {{Route::is('pages.customer.carts') ? 'text-primary' : 'text-body'}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256"><path d="M104,216a16,16,0,1,1-16-16A16,16,0,0,1,104,216Zm88-16a16,16,0,1,0,16,16A16,16,0,0,0,192,200ZM239.71,74.14l-25.64,92.28A24.06,24.06,0,0,1,191,184H92.16A24.06,24.06,0,0,1,69,166.42L33.92,40H16a8,8,0,0,1,0-16H40a8,8,0,0,1,7.71,5.86L57.19,64H232a8,8,0,0,1,7.71,10.14ZM221.47,80H61.64l22.81,82.14A8,8,0,0,0,92.16,168H191a8,8,0,0,0,7.71-5.86Z"></path></svg>
                                </a>
                            </li>
                            <li class="nav-item">
                                <form action="{{ route('pages.auth.logout') }}" method="post">
                                    @csrf
                                    <button class="nav-link btn btn-primary rounded-pill fw-semibold text-white fs-6 px-3" type="submit">Logout</button>
                                </form>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link btn btn-primary rounded-pill fw-semibold text-white fs-6 px-3"
                                    href="{{ route('pages.merchant.dashboard') }}">Dashboard</a>
                            </li>
                        @endif
                    @endauth
                    @guest
                        <li class="nav-item">
                            <a class="nav-link btn text-primary fw-semibold fs-6 px-3"
                                href="{{ route('pages.auth.login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary rounded-pill fw-semibold text-white fs-6 px-3"
                                href="{{ route('pages.auth.register') }}">Register</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
</nav>

