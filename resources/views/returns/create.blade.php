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
                    <form class="form" action="{{ route('store.return') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 col-12 mt-3">
                                <div class="form-group">
                                    <label for="return_code" class="mb-2">Return Code</label>
                                    <input type="text"
                                        class="form-control form-control-lg @error('return_code') is-invalid @enderror"
                                        placeholder="Return Code" name="return_code" value="{{ old('return_code') }}">

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
                                        <option value="" selected @readonly(true)>
                                            {{ __('Select Loan') }}</option>

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
                                        placeholder="Employee ID" name="return_date" value="{{ old('return_date') }}">

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
                                        placeholder="Not Bad" name="condition" value="{{ old('condition') }}">

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
                                    <input type="file"
                                        class="form-control form-control-lg @error('photo_receipt') is-invalid @enderror"
                                        name="photo_receipt" value="{{ old('photo_receipt') }}">

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
                                        name="notes" id="notes" placeholder="Kondisi saat dikembalikan">{{ old('notes')}}</textarea>

                                    @error('notes')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row my-4 p-2 d-flex justify-content-between">
                                <div class="col-md-5 shadow p-3 mb-3">
                                    <label class="form-label" for="signature_admin ">Admin Signature:</label>
                                    <br />
                                    <div id="signAdmin" class="" @error('signature_admin') border border-danger
                                        @enderror></div>
                                    <br />
                                    <button id="clearAdmin" class="btn btn-danger btn-sm">Clear
                                        Signature</button>
                                    <textarea id="signatureAdmin" name="signature_admin"
                                        style="display: none;"></textarea>

                                    @error('signature_admin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>

                                <div class="col-md-5 shadow p-3 mb-3">
                                    <label class="form-label" for="signature_employee">Borrower
                                        Signature:</label>
                                    <br />
                                    <div id="signEmployee" @error('signature_employee') border border-danger @enderror>
                                    </div>
                                    <br />
                                    <button id="clearEmployee" class="btn btn-danger btn-sm">Clear
                                        Signature</button>
                                    <textarea id="signatureEmployee" name="signature_employee"
                                        style="display: none;"></textarea>

                                    @error('signature_employee')
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

<script type="text/javascript">
    var signAdmin = $('#signAdmin').signature({
        syncField: '#signatureAdmin',
        syncFormat: 'PNG'
    });
    $('#clearAdmin').click(function(e) {
        e.preventDefault();
        signAdmin.signature('clear');
        $("#signatureAdmin").val('');
    });
</script>

<script type="text/javascript">
    var signEmployee = $('#signEmployee').signature({
        syncField: '#signatureEmployee',
        syncFormat: 'PNG'
    });
    $('#clearEmployee').click(function(e) {
        e.preventDefault();
        signEmployee.signature('clear');
        $("#signatureEmployee").val('');
    });
</script>


@endpush
@endsection