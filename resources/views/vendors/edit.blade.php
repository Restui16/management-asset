@extends('layouts.app')

@section('title', 'Vendor')

@section('main')
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row mb-3">
                <div class="col-12 col-md-6 order-md-1 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-start">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Master Data</li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('index.vendor')}}">Vendor</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Vendor</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="card">
                <div class="card-header">
                    <div class="col-sm-6 col-md-12 d-flex justify-content-between">
                        {{ $title }}
                    </div>
                   
                </div>

                <div class="card-body mt-3t">
                <form class="form" action="{{ route('update.vendor', $vendors->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="row">
                             <div class="col-md-6 col-12 mt-3">
                                <div class="form-group">
                                    <label for="name" class="mb-2">Company Name</label>
                                    <input type="text"
                                        class="form-control form-control-lg @error('name') is-invalid @enderror"
                                        placeholder="PT. N" name="name" value="{{ old('name', $vendors->name) }}">

                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-12 mt-3">
                                <div class="form-group">
                                    <label for="website" class="mb-2">Website</label>
                                    <input type="text"
                                        class="form-control form-control-lg @error('website') is-invalid @enderror"
                                        placeholder="https://cth.com" name="website" value="{{ old('website', $vendors->website) }}">

                                    @error('website')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-12 mt-3">
                                <div class="form-group">
                                    <label for="email" class="mb-2">Email</label>
                                    <input type="email"
                                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                                        placeholder="your@mail.com" name="email" value="{{ old('email', $vendors->email) }}">

                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-12 mt-3">
                                <div class="form-group">
                                    <label for="phone_number" class="mb-2">Phone Number</label>
                                    <input type="tel"
                                        class="form-control form-control-lg @error('phone_number') is-invalid @enderror"
                                        name="phone_number" placeholder="0812xxxx" value="{{ old('phone_number', $vendors->phone_number) }}">

                                    @error('phone_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="address" class="mb-2">Address</label>
                                    <textarea class="form-control form-control-lg @error('address') is-invalid @enderror" name="address" id="address" placeholder="Jl. Kebon Jeruk">{{old('address', $vendors->address)}}</textarea>

                                    @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-12 d-grid gap-2 mt-3 d-md-block">
                                <button type="submit" class="btn btn-primary me-1">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <footer>
        <div class="footer clearfix mb-0 text-muted">
            <div class="float-start">
                <p>2023 &copy; Mazer</p>
            </div>
            <div class="float-end">
                <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                    by <a href="https://saugi.me">Saugi</a></p>
            </div>
        </div>
    </footer>
</div>


@push('script')

@endpush
@endsection