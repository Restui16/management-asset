@extends('layouts.app')

@section('title', 'Employees')

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
                            <li class="breadcrumb-item active" aria-current="page">Employee</li>
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

                        <a href="{{ route('create.employee')}}" class="btn icon icon-left btn-primary btn-sm d-flex align-items-center">
                            <i data-feather="plus" class="me-2"></i> Add employee</a>
                    </div>

                </div>

                <div class="card-body mt-3t">
                    <table class="table display nowrap table-hover" style="width: 100%" id="tableEmployee">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Name</th>
                                <th>Related User</th>
                                <th>Department</th>
                                <th>Job Title</th>
                                <th class="text-center">Action</th>
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


@push('script')
<script>
    $(document).ready(function() {
            $('#tableEmployee').DataTable({
                scrollX: true,
                processing: true,
                serverSide: true,
                ajax: '/employee/',
                columns:[
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nik',
                        name: 'nik'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'user.name',
                        name: 'user.name'
                    },
                    {
                        data: 'department.name',
                        name: 'department.name'
                    },
                    {
                        data: 'job.job_title',
                        name: 'job.job_title'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });
        });
</script>
@endpush
@endsection