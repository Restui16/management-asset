@extends('layouts.app')

@section('title', 'Departments')

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
                            <li class="breadcrumb-item" aria-current="page">Profile</li>
                            <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <section>
                    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('put')

                        <div>
                            <x-input-label for="current_password" :value="__('Current Password')" />
                            <x-text-input id="current_password" name="current_password" type="password"
                                class="mt-1 block w-full" autocomplete="current-password" class="form-control" />
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="password" :value="__('New Password')" />
                            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                                autocomplete="new-password" class="form-control" />
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                                class="mt-1 block w-full" autocomplete="new-password" class="form-control" />
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')"
                                class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4 mt-3">
                            <button class="btn btn-primary">{{ __('Save') }}</button>

                            @if (session('status') === 'password-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                            @endif
                        </div>
                    </form>
            </div>
        </div>
        </section>

    </div>


</div>


@push('script')

@endpush
@endsection