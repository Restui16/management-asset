@extends('layouts.app')

@section('title', 'Detail Return')

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
                            <li class="breadcrumb-item active" aria-current="page">Detail return</li>
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
                            <table>
                                <tr class="mb-5">
                                    <th>Return Code</th>
                                    <td> : {{ $returns->return_code}}</td>
                                </tr>
                                <tr>
                                    <th>Loan Code</th>
                                    <td>: {{ $returns->loan->loan_code}}</td>
                                </tr>
                                <tr>
                                    <th>Return Date</th>
                                    <td> : {{ $returns->return_date}}</td>
                                </tr>
                                <tr>
                                    <th>Condition After Loan</th>
                                    <td> : {{ $returns->condition }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6 col-12 d-flex flex-column align-items-center">
                            <h5>Photo Receipt</h5>
                            <div class="card shadow-sm" style="width: 75%;">
                                <img src="{{ asset('storage/photo_receipt/return/'. $returns->photo_receipt)}}" class="shadow-sm" style="width: 100%; height: 250px; object-fit:cover; object-position:center;" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="row my-4 p-2 d-flex justify-content-between">
                        <div class="col-md-5 col-12 mb-3">
                            <h5> Admin Signature</h5>
                            <img src="{{ asset('storage/signature_return/admin/'. $returns->signature_admin)}}" alt="signature_admin">
                            <p>{{__('Restu')}}</p>
                        </div>

                        <div class="col-md-5 col-12  mb-3">
                            <h5>Borrower Signature</h5>
                            <img src="{{ asset('storage/signature_return/employee/'. $returns->signature_employee)}}" alt="signature_employee">
                            <p>{{ $returns->loan->employee->name}}</p>    
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