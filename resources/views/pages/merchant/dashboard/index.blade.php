@extends('layouts.merchant')
@section('content')
    <div class="container">
        <h1 class="fs-3 text-primary fw-bold">Halaman Dashboard Merchant</h1>
        @session('success')
            <div class="alert alert-primary alert-dismissible show fade fs-6">
                Hallo, {{ Auth::user()->name }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endsession
    </div>

@endsection
