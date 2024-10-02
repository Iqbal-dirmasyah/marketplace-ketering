@include('partials.head')
<main>
    @include('components.shared.merchant_navbar')
    <div class="container">
        @yield('content')
    </div>
</main>
@include('partials.foot')