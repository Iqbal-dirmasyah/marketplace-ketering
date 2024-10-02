@extends('layouts.merchant')
@section('content')
    <div class="card" style="max-width: 550px">
        <div class="card-content">
            <div class="card-body">
                <h4 class="fs-4 fw-bold mb-3">Form Profile</h4>
                @if (Session::has('success'))
                    <div class="alert alert-primary alert-dismissible show fade fs-6">
                        {{ Session::get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form action="{{route('pages.merchant.update_profile')}}" method="POST" class="form form-vertical">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name" class="form-label fs-6">Nama Perusahaan</label>
                                    <input type="text" id="name"
                                        class="form-control fs-6 {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                        name="name" value="{{ old('name') ?? Auth::user()->name }}">
                                    @error('name')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="contact" class="form-label fs-6">Kontak</label>
                                    <input type="number" id="contact"
                                        class="form-control fs-6 {{ $errors->has('contact') ? 'is-invalid' : '' }}"
                                        name="contact" value="{{ old('contact') ?? Auth::user()->contact }}">
                                    @error('contact')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="address" class="form-label fs-6">Alamat</label>
                                    <textarea class="form-control fs-6 {{ $errors->has('address') ? 'is-invalid' : '' }}" id="address" name="address"
                                        rows="3">{{ old('address') ?? Auth::user()->address }}</textarea>
                                    @error('address')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description" class="form-label fs-6">Deskripsi</label>
                                    <textarea class="form-control fs-6 {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description"
                                        name="description" rows="3">{{ old('description') ?? Auth::user()->description }}</textarea>
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
