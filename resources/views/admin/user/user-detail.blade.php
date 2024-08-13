@extends('layouts.app')
@section('title') User-Detail | Admin @endsection
@section('css')
<style>
    .user-detail .form-control{
        background-color: rgba(203, 225, 240, 0.658);
    }
</style>

@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1')
Admin
@endslot
@slot('title')
User Detail
@endslot
@endcomponent
<div class="col-12">
    <div class="card user-detail">
        <form>
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2>User Detail</h2>
                <a href="{{ route('admin.user.list') }}" class="btn btn-dark"><i class="fa fa-arrow-left me-1" aria-hidden="true"></i>Back</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input readonly name="name" type="text" class="form-control" value="{{ $user->name }}">

                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Email</label>
                        <input readonly name="name" type="text" class="form-control" value="{{ $user->email }}">

                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Account Type</label>
                        <input readonly name="name" type="text" class="form-control" value="{{ $user->role }}">

                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Country</label>
                        <input readonly name="name" type="text" class="form-control" value="{{ $user->country }}">

                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Phone No</label>
                        <input readonly name="name" type="text" class="form-control" value="{{ $user->phone_number }}">

                    </div>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection
@section('script')


@endsection
