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
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Form</li>
                            <li class="breadcrumb-item active" aria-current="page">Form Loan</li>
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

                        <a href="{{ route('create.loan')}}"
                            class="btn icon icon-left btn-primary btn-sm d-flex align-items-center">
                            <i data-feather="plus" class="me-2"></i> Add Loan</a>
                    </div>

                </div>

                <div class="card-body mt-3t">
                    <table class="table display nowrap table-hover table-responsive" style="width: 100%"
                        id="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Loan Code</th>
                                <th>PIC</th>
                                <th>Employee Borrowed</th>
                                <th>Loan Date</th>
                                <th>Return Date</th>
                                <th>Photo Receipt</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
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

@foreach($loans as $loan)
    <div class="modal fade" id="galleryModal{{ $loan->id }}" tabindex="-1" role="dialog"
        aria-labelledby="galleryModalTitle{{ $loan->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="galleryModalTitle{{ $loan->id }}">Photo Receipt</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>

                <div class="modal-body text-center">
                    <img class="w-50"
                        src="{{ asset('storage/photo_receipt/loan/' . $loan->photo_receipt ) }}">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
        
    @endforeach


@push('script')
<script>
    $(document).ready(function() {
            $('#data-table').DataTable({
                scrollX: true,
                processing: true,
                serverSide: true,
                ajax: '/loan/',
                columns:[
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: 'text-center'
                    },
                    {
                        data: 'loan_code',
                        name: 'loan_code'
                    },
                    {
                        data: 'pic',
                        name: 'pic'
                    },
                    {
                        data: 'employee.name',
                        name: 'employee.name',
                        className: 'text-center'
                    },
                    {
                        data: 'loan_date',
                        name: 'loan_date',
                        className: 'text-center'
                    },
                    {
                        data: 'returnDate',
                        name: 'returnDate',
                        className: 'text-center'
                    },
                    {
                        data: 'photoReceipt',
                        name: 'photoReceipt',
                        className: 'text-center'
                    },
                    {
                        data: 'action',
                        nama: 'action',
                        className: 'text-center'
                    }
                ]
                
            });
        });
</script>
@endpush
@endsection