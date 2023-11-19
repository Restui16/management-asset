@extends('layouts.app')

@section('title', 'Assets')

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
                            <li class="breadcrumb-item active" aria-current="page"><a
                                    href="{{ route('index.asset')}}">Asset</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Asset</li>
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
                    <form class="form" action="{{ route('update.asset', $assets->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="row">
                            <div class="col-md-6 col-12 mt-3">
                                <div class="form-group">
                                    <label for="name" class="mb-2">Asset Name</label>
                                    <input type="text"
                                        class="form-control form-control-lg @error('name') is-invalid @enderror"
                                        placeholder="Asset Name" name="name" value="{{ old('name', $assets->name) }}">

                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-12 mt-3">
                                <label for="category_asset_id" class="mb-2">Category</label>
                                <div class="form-group">
                                    <select class="form-select select2 @error('category_asset_id') is-invalid @enderror"
                                        name="category_asset_id" id="category_asset_id"
                                        data-placeholder="Select Category">
                                        <option value="" selected @readonly(true)>
                                            {{ __('Select Category') }}</option>

                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_asset_id', $assets->category_asset_id == $category->id ? 'selected' : '')}}>
                                            {{ $category->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('category_asset_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-12 mt-3">
                                <label for="vendor_id" class="mb-2">Vendor</label>
                                <div class="form-group ">
                                    <select class="form-select select2 @error('vendor_id') is-invalid @enderror"
                                        name="vendor_id" id="vendor_id" data-placeholder="Select Vendor">
                                        <option value="" selected @readonly(true)>
                                            {{ __('Select Vendor') }}</option>

                                        @foreach ($vendors as $vendor)
                                        <option value="{{ $vendor->id }}" {{ old('vendor_id', $vendor->id == $assets->vendor_id ? 'selected' : '')}}>
                                            {{ $vendor->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('vendor_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-12 mt-3">
                                <label for="location_id" class="mb-2">Location Asset</label>
                                <div class="form-group">
                                    <select class="form-select select2 @error('location_id') is-invalid @enderror"
                                        name="location_id" id="location_id" data-placeholder="Select Location">
                                        <option value="" selected @readonly(true)>
                                            {{ __('Select Location') }}</option>

                                        @foreach ($locations as $location)
                                        <option value="{{ $location->id }}" {{ old('location_id', $assets->location_id == $location->id ? 'selected' : '')}}>
                                            {{ $location->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('location_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-12 mt-3">
                                <label for="condition" class="mb-2">Condition</label>
                                <div class="form-group">
                                    <select class="form-select select2 @error('condition') is-invalid @enderror"
                                        name="condition" id="condition" data-placeholder="Select Condition">
                                        <option value="" selected @readonly(true)>
                                            {{ __('Select Condition') }}</option>

                                        <option value="good" {{ $assets->condition == 'good' ? 'selected' : ''}}>Good</option>
                                        <option value="not bad" {{ $assets->condition == 'not bad' ? 'selected' : ''}}>Not Bad</option>  
                                        <option value="bad" {{ $assets->condition == 'bad' ? 'selected' : ''}}>Bad</option>  
                                    </select>

                                    @error('condition')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-12 mt-3">
                                <label for="status" class="mb-2">Status</label>
                                <div class="form-group">
                                    <select class="form-select select2 @error('status') is-invalid @enderror"
                                        name="status" id="status" data-placeholder="Select Status">
                                        <option value="" selected @readonly(true)>
                                            {{ __('Select Status') }}</option>

                                        <option value="available" {{ $assets->status == 'available' ? 'selected' : ''}}>Available</option>
                                        <option value="loaned" {{ $assets->status == 'loaned' ? 'selected' : ''}}>Loaned</option>
                                    </select>

                                    @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-12 mt-3">
                                <div class="form-group">
                                    <label for="price" class="mb-2">Price</label>
                                    <input type="text"
                                        class="form-control form-control-lg @error('price') is-invalid @enderror"
                                        placeholder="8500000" name="price" value="{{ old('price', $assets->price) }}">

                                    @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-12 mt-3">
                                <div class="form-group">
                                    <label for="purchase_date" class="mb-2">Purchase Date</label>
                                    <input type="date"
                                        class="form-control form-control-lg @error('purchase_date') is-invalid @enderror"
                                        name="purchase_date" placeholder="0812xxxx" value="{{ old('purchase_date', $assets->purchase_date) }}">

                                    @error('purchase_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-12 mt-3">
                                <div class="form-group">
                                    <label for="serial_number" class="mb-2">Serial Number</label>
                                    <input type="text"
                                        class="form-control form-control-lg @error('serial_number') is-invalid @enderror"
                                        placeholder="25334xxxx" name="serial_number" value="{{ old('serial_number', $assets->serial_number) }}">

                                    @error('serial_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-6 col-12 mt-3">
                                <div class="form-group">
                                    <label for="description" class="mb-2">Description</label>
                                    <textarea
                                        class="form-control form-control-lg @error('description') is-invalid @enderror"
                                        name="description" id="description" placeholder="spesifikasi">{{ old('description', $assets->description)}}</textarea>

                                    @error('description')
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