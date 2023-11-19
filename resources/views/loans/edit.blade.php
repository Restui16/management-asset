@extends('layouts.app')

@section('title', 'Loan')

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
                                    href="{{ route('index.loan')}}">Loan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create Loan</li>
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
                    <form class="form" action="{{ route('store.loan') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 col-12 mt-3">
                                <div class="form-group">
                                    <label for="loan_code" class="mb-2">Loan Code</label>
                                    <input type="text"
                                        class="form-control form-control-lg @error('loan_code') is-invalid @enderror"
                                        placeholder="Loan Code" name="loan_code"
                                        value="{{ old('loan_code', $loans->loan_code) }}">

                                    @error('loan_code')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-12 mt-3">
                                <label for="employee_id" class="mb-2">Employee Borrowed</label>
                                <div class="form-group ">
                                    <select class="form-select select2 @error('employee_id') is-invalid @enderror"
                                        name="employee_id" id="employee_id" data-placeholder="Select Employee">
                                        <option value="" selected @readonly(true)>
                                            {{ __('Select Employee') }}</option>

                                        @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ old('employee_id', $loans->employee_id ==
                                            $employee->id ? 'selected' : '')}}>
                                            {{ $employee->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('employee_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            @foreach ($assetLoans as $assetLoan)
                            <div class="col-12">
                                <label for="asset" class="mb-2">Asset {{ $loop->iteration}}</label>
                                <div class="form-group">
                                    <select class="form-select select2 @error('asset_id') is-invalid @enderror"
                                        name="asset_id" id="assets" data-placeholder="Select Assets">
                                        <option value="">Select Asset</option>
                                        <option value="{{ $assetLoan->loan_id }}" {{ old('asset_id', $assetLoan->loan_id
                                            == $loans->id ? 'selected' : '')}}>
                                            {{ $assetLoan->asset->name }}
                                        </option>
                                        @foreach ($assets as $asset)
                                        <option value="{{ $asset->id }}">
                                            {{ $asset->name }}
                                        </option>
                                        @endforeach

                                    </select>
                                    @error('asset_id')
                                    <div class="invalid-feedback" style="margin-top:-1.25rem; display: block;">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            @endforeach

                            <div class="col-md-6 col-12 mt-3">
                                <div class="form-group">
                                    <label for="loan_date" class="mb-2">Loan Date</label>
                                    <input type="date"
                                        class="form-control form-control-lg @error('loan_date') is-invalid @enderror"
                                        placeholder="Employee ID" name="loan_date"
                                        value="{{ old('loan_date', $loans->loan_date) }}">

                                    @error('loan_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-12 mt-3">
                                <div class="form-group">
                                    <label for="return_date" class="mb-2">Return Date</label>
                                    <input type="date"
                                        class="form-control form-control-lg @error('return_date') is-invalid @enderror"
                                        placeholder="Employee ID" name="return_date"
                                        value="{{ old('return_date', $loans->return_date) }}">

                                    @error('return_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-12 mt-3">
                                <div class="form-group">
                                    <label for="photo_receipt" class="mb-2">Photo Receipt</label>
                                    <input type="file" id="photo_receipt"
                                        class="form-control form-control-lg @error('photo_receipt') is-invalid @enderror"
                                        name="photo_receipt" value="{{ old('photo_receipt') }}">

                                    <div class="mt-2">
                                        <img src="{{ asset('storage/photo_receipt/'. $loans->photo_receipt) }}"
                                            class="img-thumbnail img-preview" width="50px">
                                    </div>
                                    @error('photo_receipt')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-6 col-12 mt-3">
                                <div class="form-group">
                                    <label for="notes" class="mb-2">Notes</label>
                                    <textarea class="form-control form-control-lg @error('notes') is-invalid @enderror"
                                        name="notes" id="notes"
                                        placeholder="Kondisi saat diserahkan">{{ old('notes', $loans->notes)}}</textarea>

                                    @error('notes')
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

<script>
    $('#photo_receipt').change(function() {
        previewImage(this);
    });

    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.img-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script>
    $(document).ready(function(){
        $('#single-select2').select2({
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
        });
    });
</script>

@endpush
@endsection