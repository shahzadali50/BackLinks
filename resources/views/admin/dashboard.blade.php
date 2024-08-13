@extends('layouts.app')
@section('title') Home | Admin @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1')
Admin
@endslot
@slot('title')
Home
@endslot
@endcomponent
<div class="col-12">
    <h1>Welcome, {{ auth()->user()->name }}</h1>
</div>
@endsection
@section('script')


@endsection

