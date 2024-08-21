@extends('layouts.app')
@section('title')
Add Web | {{ auth()->user()->role }}
@endsection
@section('css')
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1')
publishers
@endslot
@slot('title')
Add Web
@endslot
@endcomponent
<div class="row">
    <div class="col-12">
        <div class="card tabs-card">
            <div class="card-body">

                <ul class="nav nav-pills nav-justified mb-3" role="tablist">
                    <li class="nav-item waves-effect waves-light">

                        <a class="nav-link active " data-bs-toggle="tab" href="#pill-justified-home-1" role="tab">
                            Enter the URL
                        </a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link disabled " data-bs-toggle="tab" href="#pill-justified-profile-1" role="tab"
                            aria-disabled="true">
                            Complete the data
                        </a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link disabled " data-bs-toggle="tab" href="#pill-justified-messages-1" role="tab"
                            aria-disabled="true">
                            Verify your website
                        </a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link disabled " data-bs-toggle="tab" href="#pill-justified-messages-1" role="tab"
                            aria-disabled="true">

                                    Finished
                        </a>
                    </li>

                </ul>
                <!-- Tab panes -->
                <div class="tab-content text-muted">
                    <div class="tab-pane active" id="pill-justified-home-1" role="tabpanel">
                        <div class="col-12">
                            <div>
                                <div class="card-header">
                                    <div class="d-flex ">
                                        <span style="font-size: 18px;" class="badge badge-label bg-warning "><i
                                            class="mdi mdi-circle-medium"></i> Step-1</span>

                                    </div>

                                    <p style="font-weight: 700" class="text-muted mb-0 py-3">Please complete the data.
                                        Fields marked with <span class="text-danger">*</span> are required.
                                    </p>
                                </div>
                                <div class="card-body">

                                    <form action="{{ route('publishers.form.postStep1') }}" method="POST">
                                        @csrf
                                        <div class="row">

                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="project_name" class="form-label">URL of your website <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input name="web_url" type="url" class="form-control" id="web_url" value="{{ old('web_url') }}" placeholder="https://www.publisuites.com" required>
                                                    @error('web_url')
                                                    <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                                        <i class="ri-error-warning-line label-icon"></i><strong>{{ $message }}</strong>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <a href="{{ route('publishers.website') }}" class="btn btn-dark">
                                                    Cancel

                                                </a>

                                                <button type="submit" class="btn btn-success waves-effect waves-light"> Next<i class="fa fa-arrow-right ms-1"></i>
                                                </button>

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

</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>
@endsection
