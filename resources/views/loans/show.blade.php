@extends('layouts.app')

@section('title', 'Detail Loan')

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
                            <li class="breadcrumb-item active" aria-current="page">Detail Loan</li>
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
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <table class="d-flex ">
                                <tr>
                                    <th>Loan Code</th>
                                    <td>: {{ $loans->loan_code}}</td>
                                </tr>
                                <tr>
                                    <th>Loan Date</th>
                                    <td>: {{ $loans->loan_date}}</td>
                                </tr>
                                <tr>
                                    <th>Return Date</th>
                                    <td>: @if($loans->return_date == null )
                                        Empty
                                        @else
                                        {{$loans->return_date}}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>PIC</th>
                                    <td>: {{ $loans->pic }}</td>
                                </tr>
                                <tr>
                                    <th>Employee Borrowed</th>
                                    <td>: {{$loans->employee->name}}</td>
                                </tr>
                            </table>
                            <span class="fw-bold">Asset : </span>
                            <table class="mt-2 table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Asset Name</th>
                                        <th>Serial Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($assetLoans as $assetLoan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $assetLoan->asset->name}}</td>
                                        <td>{{ $assetLoan->asset->serial_number}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 col-12 text-center">
                            <h3 class="text-center">Photo Receipt</h3>
                            <img src="{{ asset('storage/photo_receipt/loan/'. $loans->photo_receipt)}}"
                                class="w-75 h-75" style="object-fit: cover" alt="">
                        </div>
                    </div>

                    <div class="row">
                        <div class="container d-flex justify-content-between align-items-center p-4">
                            <div class="signature-admin">
                                <div class="card">
                                    <div class="card-header">PIC</div>
                                    <div class="card-body">
                                        <img src="{{ asset('storage/signature_loan/admin/'. $loans->signature_admin)}}"
                                            style="width:100%; object-fit:cover; object-position:center" alt="">
                                    </div>
                                    <div class="card-footer">{{ $loans->pic}}</div>
                                </div>
                            </div>
                            <div class="signature-borrowe">
                                <div class="card">
                                    <div class="card-header">Employee Borrowed</div>
                                    <div class="card-body">
                                    <img src="{{ asset('storage/signature_loan/employee/'. $loans->signature_employee)}}"
                                        style="width: 100%; object-fit:cover; object-position:center" alt="">
                                    </div>
                                    <div class="card-footer">
                                        {{$loans->employee->name}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
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