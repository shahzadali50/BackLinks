@extends('layouts.app')
@section('title')
Project | {{ auth()->user()->role }}
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1')
Reset Email
@endslot
@slot('title')
{{ auth()->user()->role }}

@endslot
@endcomponent
<div class="row">
    <div class="col-12">
        @if (session('success'))
        <div class="alert alert-primary  alert-dismissible bg-primary     text-white alert-label-icon fade show"
            role="alert">
           <img style="width: 30px;" class="img-fluid" src="{{ url('build/images/profile/email-varify.svg') }}" alt=""> <strong>Success</strong> - {{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card mt-4">
            <div class="card-body p-4">
                <div class="mb-4">
                    <div class="avatar-lg mx-auto">
                        <div class="avatar-title bg-light text-primary display-5 rounded-circle">
                            <i class="ri-mail-line"></i>
                        </div>
                    </div>
                </div>

                <div class="p-2 mt-4">
                    <div class="text-muted text-center mb-4 mx-lg-3">
                        <h4 class="">Verify Your Email</h4>
                        <p>Please enter the OTP code sent to <span class="fw-semibold">example@gmail.com</span></p>
                    </div>
                    <form action="{{
                        Auth::user()->role == 'advertiser' ? route('advertiser.verify.email.otp') :
                        (Auth::user()->role == 'admin' ? route('admin.verify.email.otp') :
                        route('publishers.verify.email.otp'))}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input required name="email_code" type="number"
                                class="form-control @error('email_code') is-invalid @enderror" placeholder="Enter OTP"
                                value="{{ old('email_code') }}">
                            @error('email_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Enter New Email Address</label>
                            <input required name="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" id="email"
                                placeholder="Enter New Email Address" value="{{ old('email') }}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-success w-100">Confirm</button>
                        </div>
                    </form>

                </div>
            </div>
            <!-- end card body -->
        </div>

    </div>
</div>
@endsection
