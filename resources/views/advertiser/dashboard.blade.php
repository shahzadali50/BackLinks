@extends('layouts.app')
@section('title')
Home |  {{ auth()->user()->role }}
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1')
Advertisers
@endslot
@slot('title')
Home

@endslot
@endcomponent
<div class="row">
    <h3>Welcome to {{ auth()->user()->name }}</h3>

@endsection

