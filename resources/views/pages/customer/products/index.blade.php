@extends('layouts.customer')
@section('content')
    <div class="container mt-3">
        <form action="{{route('pages.customer.products')}}" class="row justify-content-between align-items-center">
            <h1 class="col-4 fw-bold fs-3 text-primary mb-3">Produk</h1>
            <div class="col-3 ">
                <div class="input-group mb-3">
                    <input type="text" class="form-control fs-6 py-2" placeholder="Search..." name="search" aria-label="Search name of product"
                        aria-describedby="searchProduct" value="{{ request('search') }}">
                    <button class="input-group-text btn-primary text-white" id="searchProduct">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            viewBox="0 0 256 256">
                            <path
                                d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        </form>
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 gap-4">
            @if(!count($products))
                <h2 class="text-muted fw-semibold fs-4">Tidak ada produk</h2>
            @else
                @foreach ($products as $product)
                    <div class="card shadow-sm">
                        <div class="card-content">
                            <img class="card-img-top img-fluid" src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}" style="height: 13rem">
                            <div class="card-body">
                                <a href="{{ route('pages.customer.products.show', $product->id) }}"
                                    class="card-title text-primary fw-bold fs-5 fs-lg-4 text-capitalize">{{ $product->name }}</a>
                                <p class="text-primary fw-bold fs-6 text-warning">Rp {{ number_format($product->price) }}</p>
                                <p class="text-truncate m-0">
                                    {{ $product->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
