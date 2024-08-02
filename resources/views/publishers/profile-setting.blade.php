@extends('layouts.app')
@section('title') Profile-Setting | publishers @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1')
Publishers
@endslot
@slot('title')
Profile-Setting
@endslot
@endcomponent

<div class="row mb-4">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible bg-success text-white alert-label-icon fade show" role="alert">
        <i class="ri-check-double-line label-icon"></i> <strong>Success</strong> - {{ session('success') }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    @endif
</div>
<div class="position-relative mx-n4 mt-n4">
    <div class="profile-wid-bg profile-setting-img">
        <img src="{{ URL::asset('build/images/profile-bg.jpg') }}" class="profile-wid-img" alt="">

    </div>
</div>

<div class="row">
    <div class="col-xxl-3">
        <div class="card mt-n5">
            <div class="card-body p-4">
                <div class="text-center">
                    <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                        <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}"
                            class="  rounded-circle avatar-xl img-thumbnail user-profile-image"
                            alt="user-profile-image">

                    </div>
                    <h5 class="fs-16 mb-1">{{ auth()->user()->name }}</h5>
                    <p class="text-muted mb-0">{{ auth()->user()->role }} / Account</p>
                </div>
            </div>
        </div>
    </div>
    <!--end col-->
    <div class="col-xxl-9">
        <div class="card mt-xxl-n5">
            <div class="card-header">
                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">

                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#changePassword" role="tab">
                            <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                            Change Password
                        </a>
                    </li>

                </ul>
            </div>
            <div class="card-body p-4">
                <div class="tab-content">

                    <!--end tab-pane-->
                    <div class="tab-pane active" id="changePassword" role="tabpanel">

                        <form action="{{ Auth::user()->role == 'advertiser' ? route('advertiser.update.password') : route('publishers.update.password') }}" method="POST">
                            @csrf
                            <div class="row g-2">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="current-password">Old Password</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input required value="{{ old('password') }}" name="password" type="password" class="form-control pe-5 password-input" onpaste="return false" placeholder="Enter old password" id="current-password">
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="toggle-password-visibility"><i class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                        @error('password')
                                        <span class="text-danger" >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="new-password">New Password</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input required value="{{ old('new_password') }}" name="new_password" type="password" class="form-control pe-5 password-input " onpaste="return false" placeholder="Enter new password" id="new-password">
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="toggle-password-visibility"><i class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                        @error('new_password')
                                        <span class="text-danger" >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="new-password-confirmation">Confirm Password</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input required name="new_password_confirmation" value="{{ old('new_password_confirmation') }}" type="password" class="form-control pe-5 password-input" onpaste="return false" placeholder="Confirm new password" id="new-password-confirmation">
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="toggle-password-visibility"><i class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                        @error('new_password_confirmation')
                                        <span class="text-danger" >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="">
                                        <button type="submit" class="btn btn-dark">Change Password</button>
                                    </div>
                                </div>
                            </div>
                        </form>


                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-9">
        <div class="card mt-xxl-n5">
            <div class="card-header">
                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active " data-bs-toggle="tab" href="#personalDetails" role="tab">
                            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                            Personal Details
                        </a>
                    </li>

                </ul>
            </div>
            <div class="card-body p-4">
                <div class="tab-content">
                    <div class="tab-pane active " id="personalDetails" role="tabpanel">

                        <form action="{{ Auth::user()->role == 'advertiser' ? route('advertiser.update.email') : route('publishers.update.email') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="old_email" class="form-label">Old Email Address</label>
                                        <input required name="old_email" type="email" class="form-control @error('old_email') is-invalid @enderror" id="old_email"
                                            placeholder="Enter Old Email" value="{{ old('old_email') }}">
                                        @error('old_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="new_email" class="form-label">New Email Address</label>
                                        <input required name="new_email" type="email" class="form-control @error('new_email') is-invalid @enderror" id="new_email"
                                            placeholder="Enter New Email" value="{{ old('new_email') }}">
                                        @error('new_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-dark">Update</button>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </form>

                    </div>


                </div>
            </div>
        </div>
    </div>
    <!--end col-->
</div>

@endsection

