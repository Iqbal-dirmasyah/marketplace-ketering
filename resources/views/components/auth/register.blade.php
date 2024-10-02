@section('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection
<div class="auth-form">
    <div class="container position-relative">
        <a href="{{ route('pages.home') }}"
            class="btn btn-sm icon icon-left btn-primary rounded-pill position-absolute top-0 start-0 mt-5 ms-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256">
                <path
                    d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z">
                </path>
            </svg>
            Kembali</a>
        <div class="row justify-content-center align-items-center row-cols-lg-2 h-screen m-0">
            <div class="col d-none d-lg-block">
                <img src="{{ asset('images/welcome.svg') }}" alt="illustration welcome for login page"
                    class="img-fluid">
            </div>
            <div class="col">
                <form action="{{ route('pages.auth.do_register') }}" method="POST"
                    class="form rounded-3 border shadow p-4 mx-auto">
                    @csrf
                    <h1 class="fw-bold mb-2 fs-4 text-center">Pendaftaran Akun</h1>
                    <div class="d-flex gap-1 fw-semibold justify-content-center mb-4">
                        <small>Sudah punya akun?</small>
                        <a href="{{ route('pages.auth.login') }}"
                            class="text-decoration-none text-primary fs-6">Masuk</a>
                    </div>
                    <div class="mb-2">
                        <label for="name" class="form-label fs-6">Nama</label>
                        <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                            id="name" name="name" value="{{ old('name') }}">
                        @error('name')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="email" class="form-label fs-6">Email</label>
                        <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                            id="email" name="email" value="{{ old('email') }}">
                        @error('email')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label fs-6">Password</label>
                        <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password" name="password">
                        @error('password')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label fs-6">Bergabung sebagai:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" value="0"
                                id="roleMerchant" {{old('role') === '0' || !old('role') ? 'checked' : ''}}>
                            <label class="form-check-label" for="roleMerchant">
                                Merchant
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" value="1"
                                id="roleCustomer" {{old('role') === '1' ? 'checked' : ''}}>
                            <label class="form-check-label" for="roleCustomer">
                                Customer
                            </label>
                        </div>
                        @error('role')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit"
                        class="btn btn-sm btn-primary rounded-2 fw-semibold w-100 py-2">Daftar</button>
                </form>
            </div>
        </div>
    </div>
</div>
