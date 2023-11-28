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
                                        placeholder="Loan Code" name="loan_code" value="{{ old('loan_code') }}">

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
                                        <option value="{{ $employee->id }}" {{ old('employee_id') !='' ? 'selected' : ''
                                            }}>
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

                            <div class="col-12">
                                <label for="asset" class="mb-2">Asset</label>
                                <div class="form-group">
                                    <select class="form-select select2 @error('asset_id') is-invalid @enderror" name="asset_id[]" id="newAssets" data-placeholder="Select Assets">
                                        <option value="">Select Asset</option>
                                        @foreach ($assets as $asset)
                                            <option value="{{ $asset->id }}" @if (in_array($asset->id, old('asset_id[]', []))) data-selected="true" @endif>
                                                {{ $asset->name . ' - SN ' . $asset->serial_number}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('asset_id[]')
                                        <div class="invalid-feedback" style="margin-top:-1.25rem; display: block;">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-12 mt-3" id="newAssetRow"></div>
                            
                            <div class="row">
                                <div class="col-md-4 col-12 d-flex gap-3">
                                    <a href="#" class="btn text-center icon icon-left btn-primary btn-sm d-flex align-items-center justify-content-center" id="addAsset">
                                        <i data-feather="plus" class="me-2"></i> Add Asset
                                    </a>
                                    <div id="deleteAssetContainer" style="display: none;">
                                        <a href="#" class="btn text-center icon icon-left btn-outline-danger btn-sm d-flex align-items-center justify-content-center" id="deleteAsset">
                                            <i data-feather="x" class="me-2"></i> Delete Asset
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12 mt-3">
                                <div class="form-group">
                                    <label for="loan_date" class="mb-2">Loan Date</label>
                                    <input type="date"
                                        class="form-control form-control-lg @error('loan_date') is-invalid @enderror"
                                        placeholder="Employee ID" name="loan_date" value="{{ old('loan_date') }}">

                                    @error('loan_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            @if(Auth::user()->role == 'superadmin')
                                
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
                            @endif
                              
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
                                        name="notes" id="notes" placeholder="Kondisi saat diserahkan"></textarea>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

<script>
    var incrementalId = 2;
    var scrollDownAmount = 100;
    var scrollUpAmount = 100;

    $(document).ready(function () {
        $('#addAsset').click(function () {
            var newRowAsset = '';
            newRowAsset += `
                <div class="form-group @error('asset_id[]') is-invalid @enderror" id="rowAsset${incrementalId}">
                    <label for="asset" class="mb-2">Asset ${incrementalId}</label>
                    <select class="form-select  select2" name="asset_id[]" id="newAssets${incrementalId}" data-placeholder="Select Asset">
                        <option value="" selected @readonly(true)>Select Asset</option>
                        @foreach ($assets as $asset)
                            @if (!in_array($asset->id, old('asset_id[]', [])))
                                <option value="{{ $asset->id }}">{{ $asset->name . ' - SN ' . $asset->serial_number }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>`;

            $('#newAssetRow').append(newRowAsset);

            // Inisialisasi kembali Select2
            initSelect2();

            incrementalId++;

            if (incrementalId > 2) {
                $('#deleteAssetContainer').show();
            }

            // Scroll ke bawah dengan efek easing
            scrollDown();
        });

        $('#deleteAsset').click(function () {
            incrementalId--;

            $(`#rowAsset${incrementalId}`).remove();

            if (incrementalId === 2) {
                $('#deleteAssetContainer').hide();
            }

            // Scroll ke atas dengan efek easing
            scrollUp();
        });

        // Fungsi untuk menginisialisasi Select2
        function initSelect2() {
            $('[id^="newAssets"]').select2({
                theme: 'bootstrap-5',
                placeholder: $(this).data('placeholder'),
            });

            // Hapus opsi yang sudah dipilih sebelumnya dari opsi yang baru
            $('[id^="newAssets"]').each(function () {
                var selectedValue = $(this).find(':selected').val();
                $('[id^="newAssets"]').not(this).find('option[value="' + selectedValue + '"]').remove();
            });
        }

        function scrollDown() {
            var targetScroll = $(document).scrollTop() + scrollDownAmount;
            $('html, body').animate({
                scrollTop: Math.min(targetScroll, $(document).height() - $(window).height())
            }, 100, 'easeInOutExpo');
        }

        function scrollUp() {
            $('html, body').animate({
                scrollTop: Math.max(0, $(document).scrollTop() - scrollUpAmount)
            }, 100, 'easeInOutExpo');
        }
    });
</script>


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