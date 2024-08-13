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
    {{-- <div class="col-md-8 col-12 py-2">
        @if(session('success'))
         <div class="alert alert-secondary alert-dismissible bg-secondary text-white alert-label-icon fade show" role="alert">
             <i class="ri-check-double-line label-icon"></i> <strong>Success</strong> - {{ session('success') }}
             <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
         @endif
     </div> --}}
    <div class="col-12">
        <!-- Primary Alert -->
        <div class="alert alert-dark border-dark" role="alert">
            <strong>We need to verify, for security reasons, that this website belongs to you. You have 3 different
                ways:</strong>
        </div>


    </div>
    <div class="col-md-10">

        <div class="card">

            <div class="card-header d-flex justify-content-between">
                <h3 class="mb-1 ">
                    3. Verify your website</h3>
                <a href="{{ route('publishers.add.websiteStep4') }}" class="btn btn-success">
                    Continue<i class="fa fa-arrow-right ms-1" aria-hidden="true"></i>

                </a>
            </div>
            <div class="row p-3">
                {{-- Code --}}
                <div class="col-md-4">
                    <div class="card text-center" style="background-color: #d6d6d657">
                        <div class="text-center mt-2">
                            <img style="width: 80px; height:80px;" src="{{ url('build/images/add-web/code.svg') }}">

                        </div>
                        <div class="card-body">
                            <h4 class="">Code</h4>
                            <p class="card-text">Add this code between the head tags of your website</p>

                        </div>
                    </div>



                </div>
                {{-- Server --}}
                <div class="col-md-4">
                    <div class="card text-center" style="background-color: #d6d6d657">
                        <div class="text-center mt-2">
                            <img style="width: 80px; height:80px;" src="{{ url('build/images/add-web/server.svg') }}">

                        </div>
                        <div class="card-body">
                            <h4 class="">Server</h4>
                            <p class="card-text">Download the file and upload it to the root folder of your website</p>

                        </div>
                    </div>



                </div>
                {{-- Analytics --}}
                <div class="col-md-4">
                    <div class="card text-center" style="background-color: #d6d6d657">
                        <div class="text-center mt-2">
                            <img style="width: 80px; height:80px;" src="{{ url('build/images/add-web/analysis.svg') }}">

                        </div>
                        <div class="card-body">
                            <h4 class="">Analytics</h4>
                            <p class="card-text">Link your Analitycs account and verify your website</p>

                        </div>
                    </div>



                </div>
            </div>

        </div>

    </div>
    <div class="col-md-2 col-sm-3 d-none d-sm-block bg-new-lighter p-0 m-0">
        <div class="lateral-aside">
            <!-- Step 1 -->
            <div class="div-paso">
                <div class="badges-pasos">
                    <div class="circle-pasos circle-activep"><i class="fa fa-check" aria-hidden="true"></i></div>
                    <div class="line-pasos-donep"></div>
                </div>
                <div class="texto-pasos">
                    <p class="p-pasos-active">Enter the URL</p>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="div-paso">
                <div class="badges-pasos">
                    <div class="circle-pasos circle-activep"><i class="fa fa-check" aria-hidden="true"></i></div>
                    <div class="line-pasos-donep"></div>
                </div>
                <div class="texto-pasos">
                    <p class="p-pasos-active">Complete the data</p>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="div-paso">
                <div class="badges-pasos">
                    <div class="circle-pasos circle-activep">3</div>
                    <div class="line-pasos-donep"></div>
                </div>
                <div class="texto-pasos">
                    <p class="p-pasos-active">
                        Verify your website</p>
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
