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
    <div class="col-8">
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible bg-danger text-white alert-label-icon fade show" role="alert">
            <i class="ri-alert-line label-icon"></i><strong>{{ session('error') }}</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <ul class="nav nav-pills nav-justified mb-3" role="tablist">
                    <li class="nav-item waves-effect waves-light">

                        <a class="nav-link active" data-bs-toggle="tab" href="#pill-justified-home-1" role="tab">
                            Fill in your project data
                        </a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link disabled" data-bs-toggle="tab" href="#pill-justified-profile-1" role="tab"
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

                                    <form action="{{ route('advertiser.storeStep1') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <!-- Project Name -->
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="project_name" class="form-label">Project name <span class="text-danger">*</span></label>
                                                    <input required name="project_name" type="text" class="form-control" id="project_name" placeholder="Enter Project name" value="{{ old('project_name') }}">
                                                    @error('project_name')
                                                    <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                                        <i class="ri-error-warning-line label-icon"></i><strong>{{ $message }}</strong>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Project URL -->
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="project_url" class="form-label">URL of website <span class="text-danger">*</span></label>
                                                    <input required value="{{ old('url_website') }}" name="url_website" type="url" class="form-control" id="project_url" placeholder="Enter URL of website">
                                                    @error('url_website')
                                                    <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                                        <i class="ri-error-warning-line label-icon"></i><strong>{{ $message }}</strong>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Project Categories -->
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <div>

                                                        <label for="Project_categories">Project categories <span class="text-danger">*</span></label>
                                                    </div>
                                                    <select required class="js-example-basic-multiple" name="categories[]" multiple="multiple" id="Project_categories">
                                                        @foreach (config('categories.categories') as $category)
                                                        <option value="{{ $category['label'] }}" {{ in_array($category['label'], old('categories', [])) ? 'selected' : '' }}>
                                                            {{ $category['label'] }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('categories')
                                                    <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                                        <i class="ri-error-warning-line label-icon"></i><strong>{{ $message }}</strong>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Project Languages -->
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <div>

                                                        <label for="Project_Language">Language(s) of your project <span class="text-danger">*</span></label>
                                                    </div>
                                                    <select required class="js-example-basic-multiple" name="language[]" multiple="multiple" id="Project_Language">
                                                        <option value="" disabled>Select one or more options</option>
                                                        <option value="catalan" {{ in_array('catalan', old('language', [])) ? 'selected' : '' }}>Catalán</option>
                                                        <option value="english" {{ in_array('english', old('language', [])) ? 'selected' : '' }}>English</option>
                                                        <option value="esukera" {{ in_array('esukera', old('language', [])) ? 'selected' : '' }}>Esukera</option>
                                                        <option value="french" {{ in_array('french', old('language', [])) ? 'selected' : '' }}>French</option>
                                                        <option value="gallego" {{ in_array('gallego', old('language', [])) ? 'selected' : '' }}>Gallego</option>
                                                        <option value="german" {{ in_array('german', old('language', [])) ? 'selected' : '' }}>German</option>
                                                        <option value="italiano" {{ in_array('italiano', old('language', [])) ? 'selected' : '' }}>Italiano</option>
                                                        <option value="portuguese" {{ in_array('portuguese', old('language', [])) ? 'selected' : '' }}>Portuguese</option>
                                                        <option value="spanish" {{ in_array('spanish', old('language', [])) ? 'selected' : '' }}>Spanish</option>
                                                    </select>
                                                    @error('language')
                                                    <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                                        <i class="ri-error-warning-line label-icon"></i><strong>{{ $message }}</strong>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Project Countries -->
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <div>

                                                        <label for="Project_Country">Country or countries of your project <span class="text-danger">*</span></label>
                                                    </div>
                                                    <select required class="js-example-basic-multiple" name="countries[]" multiple="multiple" id="Project_Country">
                                                        @foreach(config('countries.countries') as $country)
                                                        <option value="{{ $country }}" {{ in_array($country, old('countries', [])) ? 'selected' : '' }}>
                                                            {{ $country }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('countries')
                                                    <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                                        <i class="ri-error-warning-line label-icon"></i><strong>{{ $message }}</strong>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Project Objectives -->
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <div>

                                                        <label for="Project_Objectives">Objectives of your project <span class="text-danger">*</span></label>
                                                    </div>
                                                    <select required class="js-example-basic-multiple" name="objectives[]" multiple="multiple" id="Project_Objectives">
                                                        <option value="" disabled>Select one or more options</option>
                                                        <option value="Increase SEO traffic" {{ in_array('Increase SEO traffic', old('objectives', [])) ? 'selected' : '' }}>Increase SEO traffic</option>
                                                        <option value="Selling more" {{ in_array('Selling more', old('objectives', [])) ? 'selected' : '' }}>Selling more</option>
                                                        <option value="Improve reputation" {{ in_array('Improve reputation', old('objectives', [])) ? 'selected' : '' }}>Improve reputation</option>
                                                        <option value="Branding" {{ in_array('Branding', old('objectives', [])) ? 'selected' : '' }}>Branding</option>
                                                    </select>
                                                    @error('objectives')
                                                    <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                                        <i class="ri-error-warning-line label-icon"></i><strong>{{ $message }}</strong>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="col-12 mt-4">
                                                <a class="btn btn-dark " href="{{ route('advertiser.project.list') }}"><i class="fa fa-times pe-1" aria-hidden="true"></i>Cancel</a>
                                                <button type="submit " class="btn btn-primary  ms-3 ">Next <i class="fa fa-arrow-right" aria-hidden="true"></i></button>


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
