@extends('layouts.app')
@section('title') Home | publishers @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1')
Publishers
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

