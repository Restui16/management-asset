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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Master Data</li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('index.employee')}}">Employee</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create Employee</li>
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
                    <form class="form" action="{{ route('store.employee') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 col-12 mt-3">
                                <div class="form-group">
                                    <label for="nik" class="mb-2">NIK</label>
                                    <input type="text"
                                        class="form-control form-control-lg @error('nik') is-invalid @enderror"
                                        placeholder="Employee ID" name="nik" value="{{ old('nik') }}">

                                    @error('nik')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                             <div class="col-md-6 col-12 mt-3">
                                <div class="form-group">
                                    <label for="name" class="mb-2">Name</label>
                                    <input type="text"
                                        class="form-control form-control-lg @error('name') is-invalid @enderror"
                                        placeholder="Fullname" name="name" value="{{ old('name') }}">

                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-12 mt-3">
                                <label for="user_id" class="mb-2">Related User</label>
                                <div class="form-group">
                                    <select class="form-select select2 @error('user_id') is-invalid @enderror" name="user_id"
                                        id="user" data-placeholder="Select User">
                                        <option value="" selected @readonly(true)>
                                            {{ __('Select User') }}</option>

                                        @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') !=''
                                            ? 'selected' : '' }}>
                                            {{ $user->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('user_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-12 mt-3">
                                <label for="department_id" class="mb-2">Department</label>
                                <div class="form-group">
                                    <select class="form-select select2 @error('department_id') is-invalid @enderror" name="department_id"
                                        id="division" data-placeholder="Select Division">
                                        <option value="" selected @readonly(true)>
                                            {{ __('Select Division') }}</option>

                                        @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" {{ old('department_id') !=''
                                            ? 'selected' : '' }}>
                                            {{ $department->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('department_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-12 mt-3">
                                <label for="job_id" class="mb-2">Job Title</label>
                                <div class="form-group ">
                                    <select class="form-select select2 @error('job_id') is-invalid @enderror" name="job_id"
                                        id="job_id" data-placeholder="Select Job Title">
                                        <option value="" selected @readonly(true)>
                                            {{ __('Select Job Title') }}</option>

                                        @foreach ($jobs as $job)
                                        <option value="{{ $job->id }}" {{ old('job_id') !=''
                                            ? 'selected' : '' }}>
                                            {{ $job->job_title }}</option>
                                        @endforeach
                                    </select>

                                    @error('job_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-12 mt-3">
                                <label for="gender" class="mb-2">Gender</label>
                                <div class="form-group">
                                    <select class="form-select select2 @error('gender') is-invalid @enderror" name="gender"
                                        id="gender" data-placeholder="Select Gender">
                                        <option value="" selected @readonly(true)>
                                            {{ __('Select Gender') }}</option>

                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>

                                    @error('gender')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-12 mt-3">
                                <div class="form-group">
                                    <label for="email" class="mb-2">Email</label>
                                    <input type="email"
                                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                                        placeholder="your@mail.com" name="email" value="{{ old('email') }}">

                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                           
                            <div class="col-md-6 col-12 mt-3">
                                <div class="form-group">
                                    <label for="photo" class="mb-2">Photo</label>
                                    <input type="file"
                                        class="form-control form-control-lg @error('photo') is-invalid @enderror"
                                        name="photo" value="{{ old('photo') }}">

                                    @error('photo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-12 mt-3">
                                <div class="form-group">
                                    <label for="phone_number" class="mb-2">Phone Number</label>
                                    <input type="tel"
                                        class="form-control form-control-lg @error('phone_number') is-invalid @enderror"
                                        name="phone_number" placeholder="0812xxxx" value="{{ old('phone_number') }}">

                                    @error('phone_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="address" class="mb-2">Address</label>
                                    <textarea class="form-control form-control-lg @error('address') is-invalid @enderror" name="address" id="address" placeholder="Jl. Kebon Jeruk"></textarea>

                                    @error('address')
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

@endpush
@endsection