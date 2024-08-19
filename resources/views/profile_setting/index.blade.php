@extends('layouts.app')
@section('title')
Profile-Setting | {{ ucfirst(Auth::user()->role) }}
@endsection
@section('content')
@section('css')
<!-- Include the intl-tel-input CSS and JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<style>
    .iti {
        width: 100%;
    }
</style>
@endsection
@component('components.breadcrumb')
@slot('li_1')
Publishers
@endslot
@slot('title')
Profile-Setting
@endslot
@endcomponent
<div class="position-relative mx-n4 mt-n4">
    <div class="profile-wid-bg profile-setting-img">
        <img src="{{ URL::asset('build/images/profile-bg.jpg') }}" class="profile-wid-img" alt="">

    </div>
</div>

<div class="row">
    <div class=" col-12">
        <div class="card mt-n5">
            <div class="card-body p-4">
                <div class="text-center">
                    <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                        <img  class="rounded-circle avatar-xl img-thumbnail user-profile-image" src="{{ auth()->user()->profile_img ? url('storage/profile_images/' . auth()->user()->profile_img) : url('build/images/profile/default-profile.png') }}" alt="Profile Image">
                    </div>
                    <h5 class="fs-16 mb-1">{{ auth()->user()->name }}</h5>
                    <p class="text-muted mb-0">{{ auth()->user()->role }} / Account</p>
                </div>
            </div>
        </div>
    </div>
    {{-- Update Profile --}}
    <div class="col-12">
        <div class="card mt-xxl-n5">
            <div class="card-header">
                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">

                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="javascript:void(0);" role="tab">
                            <i class='bx bxs-image-add'></i>
                            Update Profile
                        </a>
                    </li>

                </ul>
            </div>
            <div class="card-body p-4">
                <div class="tab-content">

                    <!--end tab-pane-->
                    <div class="tab-pane active" id="changePassword" role="tabpanel">

                        <form action="{{ Auth::user()->role == 'advertiser' ? route('advertiser.update.profile') : (Auth::user()->role == 'admin' ? route('admin.update.profile') : route('publishers.update.profile')) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-2">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="profile_img">Upload image</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input required  value="{{ old('password') }}" name="profile_img"
                                                type="file" class="form-control pe-5 password-input"
                                             id="profile_img">

                                        </div>
                                        @error('profile_img')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="">
                                        <button type="submit" class="btn btn-dark">Update profile</button>
                                    </div>
                                </div>
                            </div>
                        </form>


                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- Change Password🌟 --}}
    <div class="col-12">
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

                        <form
                            action="{{ Auth::user()->role == 'advertiser' ? route('advertiser.update.password') : (Auth::user()->role == 'admin' ? route('admin.update.password') : route('publishers.update.password')) }}"
                            method="POST">
                            @csrf
                            <div class="row g-2">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="current-password">Old Password</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input required value="{{ old('password') }}" name="password"
                                                type="password" class="form-control pe-5 password-input"
                                                placeholder="Enter old password" id="current-password">
                                            <button
                                                class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                type="button" id="toggle-password-visibility"><i
                                                    class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                        @error('password')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="new-password">New Password</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input required value="{{ old('new_password') }}" name="new_password"
                                                type="password" class="form-control pe-5 password-input "
                                                placeholder="Enter new password" id="new-password">
                                            <button
                                                class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                type="button" id="toggle-password-visibility"><i
                                                    class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                        @error('new_password')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="new-password-confirmation">Confirm
                                            Password</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input required name="new_password_confirmation"
                                                value="{{ old('new_password_confirmation') }}" type="password"
                                                class="form-control pe-5 password-input"
                                                placeholder="Confirm new password" id="new-password-confirmation">
                                            <button
                                                class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                type="button" id="toggle-password-visibility"><i
                                                    class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                        @error('new_password_confirmation')
                                        <span class="text-danger">
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
    {{-- personal Detail🌟 --}}
    <div class="col-12">
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
                        <form
                            action="{{ Auth::user()->role == 'advertiser' ? route('advertiser.update.email') : (Auth::user()->role == 'admin' ? route('admin.update.email') : route('publishers.update.email')) }}"
                            method="POST">
                            @csrf

                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="old_email" class="form-label">Old Email Address</label>
                                        <input required name="old_email" type="email"
                                            class="form-control @error('old_email') is-invalid @enderror" id="old_email"
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
                                        <input required name="new_email" type="email"
                                            class="form-control @error('new_email') is-invalid @enderror" id="new_email"
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
                        @auth
                        <form class="mt-4"
                            action="{{ Auth::user()->role == 'advertiser' ? route('advertiser.addNamecountry') : '#' }}"
                            method="POST">
                            @csrf
                            <div class="row">
                                @if (Auth::user()->role == 'advertiser')
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input name="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        value="{{ auth::user()->name }}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone_number" class="form-label">Add Phone Number</label>
                                    <div>
                                        <input name="phone_number" type="text"
                                            class="form-control w-100 @error('phone_number') is-invalid @enderror"
                                            id="phone_number" placeholder="Add Phone Number"
                                            value="{{ auth::user()->phone_number }}">

                                    </div>
                                    @error('phone_number')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div>
                                        <label for="country">Country</label>
                                    </div>
                                    <select
                                        class="js-example-basic-multiple form-control @error('country') is-invalid @enderror"
                                        name="country" id="country">
                                        <option value="" selected disabled>Select Country</option>
                                        @foreach (config('countries.countries') as $country)
                                        <option value="{{ $country }}" {{ $country==auth::user()->country ? 'selected' :
                                            '' }}>
                                            {{ $country }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-dark">Update</button>
                                </div>
                                @endif

                            </div>
                        </form>
                        @endauth

                    </div>


                </div>
            </div>
        </div>
    </div>

</div>
{{-- Succcess modal when data add in data base 🛑 --}}
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center p-5">
                {{-- <lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop"
                    colors="primary:#121331,secondary:#08a88a" style="width:120px;height:120px">
                </lord-icon> --}}
                <img style="width: 60px;" class="img-fluid " src="{{ url('build/images/add-web/tick.svg') }}" alt="">

                <div class="mt-4">
                    <h4 class="mb-3">Thank You </h4>
                    <div>

                    </div>
                    <h3 id="statusMessage" class="text-muted mb-4">Project created successfully! <img
                            style="width: 30px;" class="img-fluid " src="{{ url('build/images/add-web/tick.svg') }}"
                            alt="">
                    </h3>
                    <div class="hstack gap-2 justify-content-center ">
                        <a href="javascript:void(0);" class="btn btn-success" data-bs-dismiss="modal"><i
                                class="ri-close-line me-1 align-middle"></i> Close</a>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
    $(document).ready(function() {
        @if (session('success'))
            Swal.fire({
                title: 'Thank You 👍',
                text: '{{ session('success') }}',
                icon: 'success'
            });
        @endif
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>

<!-- Initialize intl-tel-input -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var input = document.querySelector("#phone_number");
        window.intlTelInput(input, {
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        });
    });
</script>
@endsection
