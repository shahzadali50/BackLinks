@extends('layouts.app')
@section('title')
Project | {{ auth()->user()->role }}
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1')
My Project
@endslot
@slot('title')
Add Project
@endslot
@endcomponent
<div class="row">
    <div class="col-md-8">
        @if(session('success'))
        <div class="alert alert-secondary alert-dismissible bg-secondary text-white alert-label-icon fade show"
            role="alert">
            <i class="ri-check-double-line label-icon"></i> <strong>Success</strong> - {{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <ul class="nav nav-pills nav-justified mb-3" role="tablist">
                    <li class="nav-item waves-effect waves-light">

                        <a class="nav-link disabled" data-bs-toggle="tab" href="#pill-justified-home-1" role="tab">
                            Fill in your project data
                        </a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link active" data-bs-toggle="tab" href="#add-competitors" role="tab"
                            aria-disabled="true">
                            Add competitors
                        </a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link disabled" data-bs-toggle="tab" href="#pill-justified-messages-1" role="tab"
                            aria-disabled="true">
                            Add keywords
                        </a>
                    </li>

                </ul>
                <!-- Tab panes -->
                <div class="tab-content text-muted">
                    <div class="tab-pane active" id="add-competitors" role="tabpanel">
                        <div class="col-12">
                            <div>
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span style="font-size: 18px;" class="badge badge-label bg-warning "><i
                                                class="mdi mdi-circle-medium"></i> Step-2</span>
                                        <div>
                                            <a class="btn btn-dark" href=""><i class="fa fa-times pe-1"
                                                    aria-hidden="true"></i>Cancel</a>
                                        </div>
                                    </div>

                                    <p style="font-weight: 700" class="text-muted mb-0 py-3">Please complete the data.
                                        Fields marked with <span class="text-danger">*</span> are required.
                                    </p>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('advertiser.storeStep2') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <label for=""><span class="text-dark"
                                                        style="font-weight: 700">Competitors</span> You can add up to
                                                    different 3 <span class="text-danger">*</span></label>
                                            </div>

                                            <div class="col-sm-4">
                                                <input required value="{{ old('competitor1') }}" name="competitor1" type="url"
                                                    class="form-control" placeholder="https://www.competitor1.com">
                                                @error('competitor1')
                                                <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show"
                                                    role="alert">
                                                    <i
                                                        class="ri-error-warning-line label-icon"></i><strong>{{ $message }}</strong>
                                                </div>
                                                @enderror

                                            </div>
                                            <div class="col-sm-4">
                                                <input required name="competitor2" type="url" class="form-control"
                                                    placeholder="https://www.competitor2.com"
                                                    value="{{ old('competitor2') }}">
                                                @error('competitor2')
                                                <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show"
                                                    role="alert">
                                                    <i
                                                        class="ri-error-warning-line label-icon"></i><strong>{{ $message }}</strong>
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-4">
                                                <input required name="competitor3" type="url" class="form-control"
                                                    placeholder="https://www.competitor3.com"
                                                    value="{{ old('competitor3') }}">
                                                @error('competitor3')
                                                <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show"
                                                    role="alert">
                                                    <i
                                                        class="ri-error-warning-line label-icon"></i><strong>{{ $message }}</strong>
                                                </div>
                                                @enderror
                                            </div>
                                            

                                            <div class="col-12 mt-3">
                                                <button type="submit" class="btn btn-primary">Next <i
                                                        class="fa fa-arrow-right" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div>
    @endsection
    @section('script')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
    @endsection
