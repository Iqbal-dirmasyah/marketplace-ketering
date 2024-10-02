@include('partials.head')
<main>
    @if(!in_array(Route::currentRouteName(), ['pages.auth.login', 'pages.auth.register']))
        @include('components.shared.navbar')
    @endif
    @yield('content')
</main>
@include('partials.foot')