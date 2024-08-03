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
        height: 39px;
    }
</style>
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
        {{-- @if(session('success'))
        <div class="alert alert-secondary alert-dismissible bg-secondary text-white alert-label-icon fade show"
            role="alert">
            <i class="ri-check-double-line label-icon"></i> <strong>Success</strong> - {{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif --}}
    </div>
    <div class="col-xxl-6">
        <h5 class="mb-3">Pills Justified Tabs</h5>
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills nav-justified mb-3" role="tablist">
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link disabled" data-bs-toggle="tab" href="#pill-justified-home-1" role="tab">
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
                        <a class="nav-link active" data-bs-toggle="tab" href="#pill-justified-messages-1" role="tab"
                            aria-disabled="true">
                            Add keywords
                        </a>
                    </li>
                </ul>
                <div class="tab-content text-muted">
                    <div class="tab-pane active" id="pill-justified-home-1" role="tabpanel">
                        <div class="col-12">
                            <div>
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span style="font-size: 18px;" class="badge badge-label bg-warning"><i
                                                class="mdi mdi-circle-medium"></i> Step-3</span>
                                        <div>
                                            <a class="btn btn-dark" href="{{ route('advertiser.project.list') }}"><i
                                                    class="fa fa-times pe-1" aria-hidden="true"></i>Cancel</a>
                                        </div>
                                    </div>
                                    <p style="font-weight: 700" class="text-muted mb-0 py-3">Please complete the data.
                                        Fields marked with <span class="text-danger" style="font-size: 16px">*</span>
                                        are required.
                                    </p>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('advertiser.storeStep3') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="keywords" class="form-label">Introduce the keywords
                                                        (separated by comma) <span class="text-danger"
                                                            style="font-size: 16px">*</span>
                                                    </label>
                                                    <input name="keywords" class="form-control" type="text" id="keywords"
                                                        value="{{ old('keywords') }}">
                                                    @error('keywords')
                                                    <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show"
                                                        role="alert">
                                                        <i class="ri-error-warning-line label-icon"></i><strong>{{ $message }}</strong>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 ">
                                                <div class="mb-3">
                                                    <label for="trackkeywords">Where do you want to track your
                                                        keywords?<span class="text-danger"
                                                            style="font-size: 16px">*</span></label>
                                                    <select class="js-example-basic-multiple" name="trackkeywords[]"
                                                        multiple="multiple" id="trackkeywords">
                                                        @foreach (config('countries.countries') as $country)
                                                        <option value="{{ $country }}" {{ collect(old('trackkeywords'))->contains($country) ? 'selected' : '' }}>
                                                            {{ $country }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('trackkeywords')
                                                    <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show"
                                                        role="alert">
                                                        <i class="ri-error-warning-line label-icon"></i><strong>{{ $message }}</strong>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="Project_Objectives">In what type of device do you want
                                                    to keep track of the results?<span class="text-danger"
                                                        style="font-size: 16px;"> *</span></label>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3">

                                                    <input name="track_device" type="radio" class="btn-check"
                                                        id="desktop" value="desktop" {{ old('track_device') == 'desktop' ? 'checked' : '' }}>
                                                    <label class="btn btn-outline-danger" for="desktop"><i
                                                            class="fa fa-desktop me-1" aria-hidden="true"></i>Computer
                                                    </label>
                                                    <input name="track_device" type="radio" class="btn-check"
                                                        id="smartphone" value="smartphone" {{ old('track_device') == 'smartphone' ? 'checked' : '' }}>
                                                    <label class="btn btn-outline-danger" for="smartphone"><i
                                                            class='bx bx-mobile me-1'></i>Smart Phone
                                                    </label>
                                                    <input name="track_device" type="radio" class="btn-check"
                                                        id="both" value="desktop smart_phone " {{ old('track_device') == 'desktop smart_phone' ? 'checked' : '' }}>
                                                    <label class="btn btn-outline-info" for="both"><i
                                                            class='bx bxs-objects-horizontal-center me-1'></i>Both
                                                    </label>
                                                    @error('track_device')
                                                    <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show"
                                                        role="alert">
                                                        <i class="ri-error-warning-line label-icon"></i><strong>{{ $message }}</strong>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Finish <i
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
