@extends('layouts.app')
@section('title')
Add Web | {{ auth()->user()->role }}
@endsection
@section('css')
<style>
    .bg-new-lighter {
        background-color: #f8f9fa;
        /* Adjust as needed */
    }

    .lateral-aside {
        padding: 10px;
    }

    .div-paso {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .badges-pasos {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-right: 10px;
    }

    .circle-pasos {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 18px;
        color: white;
    }

    .circle-activep {
        background-color: #28a745;
        /* Green for active/completed steps */
    }

    .circle-inactive {
        background-color: #6c757d;
        /* Gray for inactive steps */
    }

    .check-pasos {
        font-size: 16px;
    }

    .line-pasos,
    .line-pasos-donep {
        width: 2px;
        height: 30px;
        background-color: #6c757d;
        /* Gray for default lines */
    }

    .line-pasos-donep {
        background-color: #28a745;
    }

    .texto-pasos {
        flex: 1;
    }

    .p-pasos-active {
        font-weight: bold;
        color: #28a745;
        /* Green for active text */
    }

    .p-pasos {
        font-weight: normal;
        color: #6c757d;
        /* Gray for inactive text */
    }
</style>

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

    <div class="col-md-10">
        <div class="card">
            <div class="card-header ">
                <h3 class="mb-1 ">
                   1. Enter the URL</h3>

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
                                    <span class="text-danger">{{ $message }}</span>
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
    <div class="col-md-2 col-sm-3 d-none d-sm-block bg-new-lighter p-0 m-0">
        <div class="lateral-aside">
            <!-- Step 1 -->
            <div class="div-paso">
                <div class="badges-pasos">
                    <div class="circle-pasos circle-activep">1</div>
                    <div class="line-pasos-donep"></div>
                </div>
                <div class="texto-pasos">
                    <p class="p-pasos-active">Enter the URL</p>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="div-paso">
                <div class="badges-pasos">
                    <div class="circle-pasos circle-inactive">2</div>
                    <div class="line-pasos"></div>
                </div>
                <div class="texto-pasos">
                    <p class="p-pasos">Complete the data</p>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="div-paso">
                <div class="badges-pasos">
                    <div class="circle-pasos circle-inactive">3</div>
                    <div class="line-pasos"></div>
                </div>
                <div class="texto-pasos">
                    <p class="p-pasos">Verify your website</p>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="div-paso">
                <div class="badges-pasos">
                    <div class="circle-pasos circle-inactive">4</div>
                </div>
                <div class="texto-pasos">
                    <p class="p-pasos">Finished</p>
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
</script>
@endsection
