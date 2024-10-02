@extends('layouts.merchant')
@section('content')
    <div class="card" style="max-width: 550px">
        <div class="card-content">
            <div class="card-body">
                <h4 class="fs-4 fw-bold mb-3">Form Tambah Produk</h4>
                <form action="{{route('pages.merchant.products.store')}}" method="POST" class="form form-vertical" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="image" class="form-label fs-6">Gambar</label>
                                    <input type="file" id="image"
                                        class="form-control fs-6 {{ $errors->has('image') ? 'is-invalid' : '' }}"
                                        name="image" accept="image/*">
                                    @error('image')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name" class="form-label fs-6">Nama produk</label>
                                    <input type="text" id="name"
                                        class="form-control fs-6 {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                        name="name" value="{{ old('name')}}">
                                    @error('name')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="price" class="form-label fs-6">Harga</label>
                                    <input type="number" id="price"
                                        class="form-control fs-6 {{ $errors->has('price') ? 'is-invalid' : '' }}"
                                        name="price" value="{{ old('price') }}">
                                    @error('price')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description" class="form-label fs-6">Deskripsi</label>
                                    <textarea class="form-control fs-6 {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" name="description"
                                        rows="3">{{ old('description')}}</textarea>
                                    @error('description')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
