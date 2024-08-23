@extends('layouts.app')
@section('title')
Project | {{ auth()->user()->role }}
@endsection
@section('css')
<style>
    .tags-input-wrapper {
        background: transparent;
        padding: 10px;
        border-radius: 4px;
        height: 39px;
        /* max-width: 400px; */
        border: 1px solid #ccc
    }


    .tags-input-wrapper input {
        border: none;
        background: transparent;
        outline: none;
        width: 140px;
        margin-left: 8px;
    }


    .tags-input-wrapper .tag {
        display: inline-block;
        background-color: #405189;
        color: white;
        border-radius: 40px;
        padding: 0px 3px 0px 7px;
        margin-right: 5px;
        margin-bottom: 5px;
    }

    .tags-input-wrapper .tag a {
        margin: 0 7px 3px;
        display: inline-block;
        cursor: pointer;
        color: white;
    }
    .select2-container .select2-selection--multiple{
        min-height: 39px;
    }
</style>
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1')
My Project
@endslot
@slot('title')
Edit
@endslot
@endcomponent
<div class="row">
    <div class="col-12">
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible bg-danger text-white alert-label-icon fade show" role="alert">
            <i class="ri-alert-line label-icon"></i><strong>{{ session('error') }}</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @elseif(session('success'))
        <div class="alert alert-success alert-dismissible bg-success text-white alert-label-icon fade show" role="alert">
            <i class="ri-check-double-line label-icon"></i><strong>{{session('success') }}</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

    </div>
    {{-- Project Data🌟 --}}
    <div class="col-12">
        <div class="card mt-xxl-n5">
            <div class="card-header">
                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">

                    <li class="nav-item">
                        <p style="font-size:16px;" class="nav-link active mb-0" data-bs-toggle="tab" href="#changePassword" role="tab">
                            <img style="width: 30px;" class="img-fluid" src="{{ url('build/images/update-icons/update-icon.svg') }}" alt="not-show">
                            Update project data
                        </p>
                    </li>

                </ul>
            </div>
            <div class="card-body p-4">
                <div class="tab-content">

                    <!--end tab-pane-->
                    <div class="tab-pane active" id="changePassword" role="tabpanel">
                        <form action="{{ route('advertiser.update.step1', $project->id) }}" method="POST">
                            @csrf
                            <div class="row">
                                <!-- Project Name -->
                                <div class="col-sm-6 mb-3">
                                    <label for="project_name" class="form-label">Project name <span class="text-danger">*</span></label>
                                    <input required  name="name" type="text" class="form-control" id="project_name" placeholder="Enter Project name" value="{{ old('project_name', $project->name) }}">
                                    @error('project_name')
                                    <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                        <i class="ri-error-warning-line label-icon"></i><strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>

                                <!-- Project URL -->
                                <div class="col-sm-6 mb-3">
                                    <label for="project_url" class="form-label">URL of website <span class="text-danger">*</span></label>
                                    <input required  value="{{ old('url', $project->url) }}" name="url" type="url" class="form-control" id="project_url" placeholder="Enter URL of website">
                                    @error('url')
                                    <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                        <i class="ri-error-warning-line label-icon"></i><strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>

                                <!-- Project Categories -->
                                <div class="col-sm-6 mb-3">
                                    <label for="Project_categories">Project categories <span class="text-danger">*</span></label>
                                    <br>
                                    <select required  class="js-example-basic-multiple form-control" name="categories[]" multiple="multiple" id="Project_categories">
                                        @foreach (config('categories.categories') as $category)
                                        <option value="{{ $category['label'] }}" {{ in_array($category['label'], old('categories', json_decode($project->categories, true) ?? [])) ? 'selected' : '' }}>
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

                                <!-- Project Languages -->
                                <div class="col-sm-6 mb-3">
                                    <label for="Project_Language">Language(s) of your project <span class="text-danger">*</span></label>
                                    <br>
                                    <select required  class="js-example-basic-multiple form-control" name="language[]" multiple="multiple" id="Project_Language">
                                        <option value="" disabled>Select one or more options</option>
                                        @foreach(['catalan', 'english', 'esukera', 'french', 'gallego', 'german', 'italiano', 'portuguese', 'spanish'] as $language)
                                        <option value="{{ $language }}" {{ in_array($language, old('language', json_decode($project->languages, true) ?? [])) ? 'selected' : '' }}>
                                            {{ ucfirst($language) }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('language')
                                    <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                        <i class="ri-error-warning-line label-icon"></i><strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>

                                <!-- Project Countries -->
                                <div class="col-sm-6 mb-3">
                                    <label for="Project_Country">Country or countries of your project <span class="text-danger">*</span></label>
                                    <br>
                                    <select required  class="js-example-basic-multiple form-control" name="countries[]" multiple="multiple" id="Project_Country">
                                        @foreach(config('countries.countries') as $country)
                                        <option value="{{ $country }}" {{ in_array($country, old('countries', json_decode($project->countries, true) ?? [])) ? 'selected' : '' }}>
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

                                <!-- Project Objectives -->
                                <div class="col-sm-6 mb-3">
                                    <label for="Project_Objectives">Objectives of your project <span class="text-danger">*</span></label>
                                    <br>
                                    <select required  class="js-example-basic-multiple form-control" name="objectives[]" multiple="multiple" id="Project_Objectives">
                                        <option value="" disabled>Select one or more options</option>
                                        @foreach(['Increase SEO traffic', 'Selling more', 'Improve reputation', 'Branding'] as $objective)
                                        <option value="{{ $objective }}" {{ in_array($objective, old('objectives', json_decode($project->objectives, true) ?? [])) ? 'selected' : '' }}>
                                            {{ $objective }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('objectives')
                                    <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                        <i class="ri-error-warning-line label-icon"></i><strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-dark ms-3">Update</button>
                                </div>
                            </div>
                        </form>




                    </div>

                </div>
            </div>
        </div>
    </div>


    {{-- Competitors 🌟 --}}
    <div class="col-12">
        <div class="card mt-xxl-n5">
            <div class="card-header">
                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">

                    <li class="nav-item">
                        <p style="font-size:16px;"  class="nav-link active mb-0" data-bs-toggle="tab" href="#changePassword" role="tab">
                           <img style="width: 30px;" class="img-fluid" src="{{ url('build/images/update-icons/update-icon.svg') }}" alt="not-show">
                            Update keywords
                        </p>
                    </li>

                </ul>
            </div>
            <div class="card-body p-4">
                <div class="tab-content">

                    <!--end tab-pane-->
                    <div class="tab-pane active" id="changePassword" role="tabpanel">

                        <form action="{{ route('advertiser.update.step2', $project->id) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <label for=""><span class="text-dark" style="font-weight: 700">Competitors</span> You can add up to 3 different competitors <span class="text-danger">*</span></label>
                                </div>

                                <div class="col-md-4 mb-md-0 mb-3">
                                    <input
                                        required
                                        value="{{ old('competitor1', $competitors['competitor1'] ?? '') }}"
                                        name="competitor1"
                                        type="url"
                                        class="form-control"
                                        placeholder="https://www.competitor1.com"
                                    >
                                    @error('competitor1')
                                        <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                            <i class="ri-error-warning-line label-icon"></i><strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-md-0 mb-3">
                                    <input
                                        required
                                        value="{{ old('competitor2', $competitors['competitor2'] ?? '') }}"
                                        name="competitor2"
                                        type="url"
                                        class="form-control"
                                        placeholder="https://www.competitor2.com"
                                    >
                                    @error('competitor2')
                                        <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                            <i class="ri-error-warning-line label-icon"></i><strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-md-0 mb-3">
                                    <input
                                        required
                                        value="{{ old('competitor3', $competitors['competitor3'] ?? '') }}"
                                        name="competitor3"
                                        type="url"
                                        class="form-control"
                                        placeholder="https://www.competitor3.com"
                                    >
                                    @error('competitor3')
                                        <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                            <i class="ri-error-warning-line label-icon"></i><strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-dark ms-3">Update</button>
                                </div>
                            </div>
                        </form>


                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Keywords🌟 --}}
    <div class="col-12">
        <div class="card mt-xxl-n5">
            <div class="card-header">
                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">

                    <li class="nav-item">
                        <p style="font-size:16px;"  class="nav-link active mb-0" data-bs-toggle="tab" href="#changePassword" role="tab">
                            <img style="width: 30px;" class="img-fluid" src="{{ url('build/images/update-icons/update-icon.svg') }}" alt="not-show">
                            Update keywords
                        </p>
                    </li>

                </ul>
            </div>
            <div class="card-body p-4">
                <div class="tab-content">

                    <!--end tab-pane-->
                    <div class="tab-pane active" id="changePassword" role="tabpanel">

                        <form action="{{ route('advertiser.update.step3', $project->id) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="keywords" class="form-label">Introduce the keywords (separated by comma) <span class="text-danger" style="font-size: 16px">*</span></label>
                                        <input name="keywords" class="form-control" type="text" id="keywords"
                                        value="{{ old('keywords', $project->keywords) }}">
                                        @error('keywords')
                                        <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                            <i class="ri-error-warning-line label-icon"></i><strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="trackkeywords">Where do you want to track your keywords?<span class="text-danger" style="font-size: 16px">*</span></label>
                                        <select class="js-example-basic-multiple form-control" name="trackkeywords[]" multiple="multiple" id="trackkeywords">
                                            @foreach (config('countries.countries') as $country)
                                                <option value="{{ $country }}" {{ collect(old('trackkeywords', json_decode($project->trackkeywords, true)))->contains($country) ? 'selected' : '' }}>
                                                    {{ $country }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('trackkeywords')
                                        <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                            <i class="ri-error-warning-line label-icon"></i><strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="Project_Objectives">In what type of device do you want to keep track of the results?<span class="text-danger" style="font-size: 16px;"> *</span></label>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <input name="track_device" type="radio" class="btn-check" id="desktop" value="desktop" {{ old('track_device', $project->track_device) == 'desktop' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-danger" for="desktop"><i class="fa fa-desktop me-1" aria-hidden="true"></i>Computer</label>

                                        <input name="track_device" type="radio" class="btn-check" id="smartphone" value="smartphone" {{ old('track_device', $project->track_device) == 'smartphone' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-danger" for="smartphone"><i class='bx bx-mobile me-1'></i>Smart Phone</label>

                                        <input name="track_device" type="radio" class="btn-check" id="both" value="desktop smart_phone" {{ old('track_device', $project->track_device) == 'desktop smart_phone' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-info" for="both"><i class='bx bxs-objects-horizontal-center me-1'></i>Both</label>

                                        @error('track_device')
                                        <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                            <i class="ri-error-warning-line label-icon"></i><strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-dark ms-3">Update</button>
                                </div>
                            </div>
                        </form>


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

        (function() {
            "use strict"

            var TagsInput = function(opts) {
                this.options = Object.assign(TagsInput.defaults, opts);
                this.init();
            }

            TagsInput.prototype.init = function(opts) {
                this.options = opts ? Object.assign(this.options, opts) : this.options;

                if (this.initialized) this.destroy();

                if (!(this.orignal_input = document.getElementById(this.options.selector))) {
                    console.error("tags-input couldn't find an element with the specified ID");
                    return this;
                }

                this.arr = [];
                this.wrapper = document.createElement('div');
                this.input = document.createElement('input');
                init(this);
                initEvents(this);

                this.initialized = true;
                return this;
            }

            TagsInput.prototype.addTag = function(string) {
                if (this.anyErrors(string)) return;

                this.arr.push(string);
                var tagInput = this;

                var tag = document.createElement('span');
                tag.className = this.options.tagClass;
                tag.innerText = string;

                var closeIcon = document.createElement('a');
                closeIcon.innerHTML = '&times;';
                closeIcon.className = 'remove';
                closeIcon.addEventListener('click', function(e) {
                    e.preventDefault();
                    var tag = this.parentNode;

                    for (var i = 0; i < tagInput.wrapper.childNodes.length; i++) {
                        if (tagInput.wrapper.childNodes[i] == tag)
                            tagInput.deleteTag(tag, i);
                    }
                })


                tag.appendChild(closeIcon);
                this.wrapper.insertBefore(tag, this.input);
                this.orignal_input.value = this.arr.join(',');

                return this;
            }

            TagsInput.prototype.deleteTag = function(tag, i) {
                tag.remove();
                this.arr.splice(i, 1);
                this.orignal_input.value = this.arr.join(',');
                return this;
            }

            TagsInput.prototype.anyErrors = function(string) {
                if (this.options.max != null && this.arr.length >= this.options.max) {
                    console.log('max tags limit reached');
                    return true;
                }

                if (!this.options.duplicate && this.arr.indexOf(string) != -1) {
                    console.log('duplicate found " ' + string + ' " ')
                    return true;
                }

                return false;
            }

            TagsInput.prototype.addData = function(array) {
                var plugin = this;

                array.forEach(function(string) {
                    plugin.addTag(string);
                })
                return this;
            }

            TagsInput.prototype.getInputString = function() {
                return this.arr.join(',');
            }

            TagsInput.prototype.destroy = function() {
                this.orignal_input.removeAttribute('hidden');

                delete this.orignal_input;
                var self = this;

                Object.keys(this).forEach(function(key) {
                    if (self[key] instanceof HTMLElement)
                        self[key].remove();

                    if (key != 'options')
                        delete self[key];
                });

                this.initialized = false;
            }

            function init(tags) {
                tags.wrapper.append(tags.input);
                tags.wrapper.classList.add(tags.options.wrapperClass);
                tags.orignal_input.setAttribute('hidden', 'true');
                tags.orignal_input.parentNode.insertBefore(tags.wrapper, tags.orignal_input);
            }

            function initEvents(tags) {
                tags.wrapper.addEventListener('click', function() {
                    tags.input.focus();
                });


                tags.input.addEventListener('keydown', function(e) {
                    var str = tags.input.value.trim();

                    if (!!(~[9, 13, 188].indexOf(e.keyCode))) {
                        e.preventDefault();
                        tags.input.value = "";
                        if (str != "") tags.addTag(str);
                    }

                });
            }

            TagsInput.defaults = {
                selector: '',
                wrapperClass: 'tags-input-wrapper',
                tagClass: 'tag',
                max: null,
                duplicate: false
            }

            window.TagsInput = TagsInput;

        })();

        var tagInput1 = new TagsInput({
            selector: 'keywords',
            duplicate: false,
            max: 10
        });

    </script>
    @endsection
