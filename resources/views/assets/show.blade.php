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
                    <table class="table table-hover">
                        <tr>
                            <th>Asset Name</th>
                            <td> : {{ $assets->name}}</td>
                        </tr>
                        <tr>
                            <th>Category Asset</th>
                            <td>: {{ $assets->CategoryAsset->name}}</td>
                        </tr>
                        <tr>
                            <th>Vendor</th>
                            <td>: {{ $assets->vendor->name }}</td>
                        </tr>
                        <tr>
                            <th>Location Asset</th>
                            <td>: {{ $assets->location->name }}</td>
                        </tr>
                        <tr>
                            <th>Serial Number</th>
                            <td>: {{$assets->serial_number}} </td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td>: Rp. {{$assets->price}} </td>
                        </tr>
                        <tr>
                            <th>Purchase Date</th>
                            <td>: {{$assets->purchase_date}} </td>
                        </tr>
                        <tr>
                            <th> Condition </th>
                            <td>: 
                                @if ($assets->condition == 'good') 
                                <span class="badge text-bg-success">Good</span>
                                @elseif($assets->condition == 'not bad')
                                <span class="badge text-bg-secondary">Not Bad</span>
                                @else
                                <span class="badge text-bg-warning">Bad</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>:
                                @if($assets->status == 'available')
                                    <span class="badge text-bg-success">Available</span>
                                @else
                                    <span class="badge text-bg-secondary">Loaned</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>: {{$assets->description}} </td>
                        </tr>
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


@push('script')

@endpush
@endsection