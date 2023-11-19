@extends('layouts.app')

@section('title', 'Return')

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
                                    href="{{ route('index.return')}}">Return</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create Return</li>
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
                    <form class="form" action="{{ route('update.return', $returns->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <input type="hidden" name="oldPhoto_receipt" value="{{ $returns->photo_receipt }}">

                        <div class="row">
                            <div class="col-md-6 col-12 mt-3">
                                <div class="form-group">
                                    <label for="return_code" class="mb-2">Return Code</label>
                                    <input type="text"
                                        class="form-control form-control-lg @error('return_code') is-invalid @enderror"
                                        placeholder="Return Code" name="return_code" value="{{ old('return_code', $returns->return_code) }}">

                                    @error('return_code')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-12 mt-3">
                                <label for="loan_id" class="mb-2">Loan Code</label>
                                <div class="form-group ">
                                    <select class="form-select select2 @error('loan_id') is-invalid @enderror"
                                        name="loan_id" id="loan_id" data-placeholder="Select Loan">
                                        <option value="" @readonly(true)>

                                            {{ __('Select Loan') }}</option>
                                        <option value="{{ $loanSelected }}" selected>{{ $loanSelected->loan_code }}</option>    

                                        @foreach ($loans as $loan)
                                        <option value="{{ $loan->id }}" {{ old('loan_id') !='' ? 'selected' : ''
                                            }}>
                                            {{ $loan->loan_code }}</option>
                                        @endforeach
                                    </select>

                                    @error('loan_id')
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
                                        placeholder="Employee ID" name="return_date" value="{{ old('return_date', $returns->return_date) }}">

                                    @error('return_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-12 mt-3">
                                <div class="form-group">
                                    <label for="condition" class="mb-2">Condition After Loan</label>
                                    <input type="text"
                                        class="form-control form-control-lg @error('condition') is-invalid @enderror"
                                        placeholder="Not Bad" name="condition" value="{{ old('condition', $returns->condition) }}">

                                    @error('condition')
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
                                            <img src="{{ asset('storage/photo_receipt/return/'. $returns->photo_receipt)}}"
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
                                        name="notes" id="notes" placeholder="Kondisi saat dikembalikan">{{ old('notes', $returns->notes)}}</textarea>

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


@endpush
@endsection