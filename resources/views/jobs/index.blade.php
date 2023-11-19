@extends('layouts.app')

@section('title', 'Jobs')

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
                            <li class="breadcrumb-item active" aria-current="page">Master Data</li>
                            <li class="breadcrumb-item active" aria-current="page">Job</li>
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

                        <button class="btn icon icon-left btn-primary btn-sm d-flex align-items-center"
                            data-bs-toggle="modal" data-bs-target="#createJob"><i data-feather="plus"
                                class="me-2"></i> Add Job</button>
                    </div>
                </div>

                <div class="card-body mt-3t">
                    <table class="table display nowrap table-hover" style="width: 100%" id="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Job Title</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobs as $job)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $job->job_title }}</td>
                                <td>{{ $job->created_at }}</td>
                                <td class="text-center">
                                    <div class="d-flex">
                                        <button class="btn btn-link" data-bs-toggle="modal"
                                            data-bs-target="#editJob{{$job->id}}" class="icon me-3"><i
                                                class="bi bi-pencil-fill" style="font-size: 0.8rem;"></i></button>
                                        
                                        <a href="#" onclick="confirmDelete(this)" data-id="{{$job->id}}" class="btn btn-link text-danger"><i class="bi bi-x"
                                            style="font-size: 1.2rem;"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
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

@include('jobs.create-modal')
@include('jobs.edit-modal')

@push('script')
    <script>
        new DataTable('#data-table');
    </script>
@endpush
@endsection