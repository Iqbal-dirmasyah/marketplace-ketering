@extends('layouts.merchant')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3 align-items-center">
                    <h1 class="fw-bold fs-3">product</h1>
                    <a href="{{ route('pages.merchant.products.create') }}" class="btn btn-primary">Add Product</a>
                </div>
                @if (Session::has('success'))
                    <div class="alert alert-primary alert-dismissible show fade fs-6">
                        {{ Session::get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <!-- table striped -->
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Deskripsi</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!count($products))
                                <tr>
                                    <td colspan="5" class="text-center">Tidak Ada Data
                                    <td class="text-center"></td>
                                </tr>
                            @else
                                @foreach ($products as $product)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}"
                                                style="width: 50px;">
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td style="width: 500px">{{ $product->description }}</td>
                                        <td>
                                            <a href="{{ route('pages.merchant.products.edit', $product->id) }}"
                                                class="btn btn-primary">Edit</a>
                                            <form action="{{ route('pages.merchant.products.destroy', $product->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
