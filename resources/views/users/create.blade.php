@extends('layouts.app')

@section('title', 'Users')

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
                            <li class="breadcrumb-item active" aria-current="page"><a
                                    href="{{ route('index.user')}}">Users</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create User</li>
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
                    <form class="form" action="{{ route('store.user') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row">
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
                                <label for="employee_id" class="mb-2">Related Employee</label>
                                <div class="form-group">
                                    <select class="form-select select2 @error('employee_id') is-invalid @enderror" name="employee_id"
                                        id="user" data-placeholder="Select Employee">
                                        <option value="" selected @readonly(true)>
                                            {{ __('Select Employee') }}</option>

                                        @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ old('employee_id') !=''
                                            ? 'selected' : '' }}>
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
                                <label for="role" class="mb-2">Role User</label>
                                <div class="form-group @error('role') is-invalid @enderror">
                                    <select class="single-select2 role form-select" name="role"
                                        id="userRole" data-placeholder="Choose Role">
                                        <option value="" selected>{{ __('Choose Role') }}</option>

                                        <option value="staff" {{ old('role')=='staff' ? 'selected' : '' }}>
                                            Staff</option>

                                            <option value="admin"
                                                {{ old('role') == 'admin' ? 'selected' : '' }}>
                                                Admin</option>

                                            @can('superadmin')
                                            <option value="admin"
                                                {{ old('role') == 'superadmin' ? 'selected' : '' }}>
                                                Super Admin</option>
                                            @endcan

                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback error-style"
                                                style="display:block; margin-top:-1.25rem;">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>


                            <div class="col-md-6 col-12 mt-3">
                                <div class="form-group">
                                    <label for="password" class="mb-2">Password</label>
                                    <input type="password"
                                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                                        name="password" placeholder="Password">

                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-12 mt-3">
                                <div class="form-group">
                                    <label for="password_confirmation" class="mb-2">Password
                                        Confirmation</label>
                                    <input type="password"
                                        class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror"
                                        name="password_confirmation" placeholder="Password Confirmation">

                                    @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 d-grid gap-2 mt-3 d-md-block">
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