@extends('layouts.customer')
@section('content')
    <div class="container mt-3">
        @error('fail')
            <div class="alert alert-danger alert-dismissible show fade fs-6">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        @if (Session::has('success'))
            <div class="alert alert-primary alert-dismissible show fade fs-6">
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <img class="card-img-top img-fluid" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                    style="height: 20rem">
            </div>
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <h1 class="card-title text-primary fw-bold fs-4 text-capitalize">{{ $product->name }}</h1>
                            <p class="text-primary fw-bold fs-6 text-warning">Rp {{ number_format($product->price) }}</p>
                            <p class="mb-4">
                                {{ $product->description }}
                            </p>
                            <p class="text-muted">Sisa: {{$product->quantity}}</p>
                            <form action="{{ route('pages.customer.products.addToCart', $product->id) }}" method="POST">
                                @csrf
                                <div class="d-flex gap-2 mb-3">
                                    <button type="button" id="decrement"
                                        class="btn btn-sm btn-primary fw-bold px-3">-</button>
                                    <input type="hidden" name="quantity" id="quantity">
                                    <input type="number" id="quantityShow" class="form-control bg-white" style="width:80px"
                                        disabled>
                                    @error('quantity')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                    <button type="button" id="increment"
                                        class="btn btn-sm btn-primary fw-bold px-3">+</button>
                                </div>
                                <button type="submit" id="add-to-cart" class="btn btn-primary me-1 mb-1">Add to
                                    cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let initialQuantity = 1;
        const quantity = document.querySelector('#quantity');
        const quantityShow = document.querySelector('#quantityShow');
        const decrementBtn = document.querySelector('#decrement');
        const incrementBtn = document.querySelector('#increment');
        const addToCartBtn = document.querySelector('#add-to-cart');

        document.addEventListener('DOMContentLoaded', () => {
            quantity.value = initialQuantity
            quantityShow.value = initialQuantity
        })

        decrementBtn.addEventListener('click', () => {
            if (quantity.value > 1) {
                quantity.value = parseInt(quantity.value) - 1
                quantityShow.value = parseInt(quantityShow.value) - 1
            }

            if (quantity.value == 0) {
                addToCartBtn.disabled = true
            }
        })

        incrementBtn.addEventListener('click', () => {
            quantity.value = parseInt(quantity.value) + 1
            quantityShow.value = parseInt(quantityShow.value) + 1

            if (quantity.value > 0) {
                addToCartBtn.disabled = false
            }
        })
    </script>
@endsection
