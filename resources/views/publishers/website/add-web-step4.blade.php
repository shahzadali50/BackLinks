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

        <div class="alert alert-secondary alert-dismissible bg-secondary text-white alert-label-icon fade show"
            role="alert">
            <i class="ri-check-double-line label-icon"></i> <strong>Success</strong> - Step 3: Data has been saved
            successfully.
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    </div> --}}

    <div class="col-12">
        <!-- Primary Alert -->
        <div class="alert alert-success ext-white" role="alert">
            <strong>Great! In the next few days we will check your web and we will notify you in case it is
                accepted.</strong>
        </div>
        <p>While you await, we can answer some frequent doubts and we give you some advices.</p>


    </div>
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
                        <a class="nav-link active " data-bs-toggle="tab" href="#pill-justified-profile-1" role="tab"
                            aria-disabled="true">
                            Complete the data
                        </a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link active " data-bs-toggle="tab" href="#pill-justified-messages-1" role="tab"
                            aria-disabled="true">
                            Verify your website
                        </a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link active " data-bs-toggle="tab" href="#pill-justified-messages-1" role="tab"
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
                                            class="mdi mdi-circle-medium"></i> Step-4</span>

                                    </div>


                                </div>
                                <div class="row p-5">
                                    {{-- Code --}}
                                    <div class="col-md-12">
                                        <div class="card p-3" style="background-color: #d6d6d657">
                                            <ul>
                                                <li class="mb-2">You have 48 hours to accept or reject orders.</li>
                                                <li class="mb-2"> Once the order is finished, you can ask for you payment. Get it in only 10
                                                    working days.</li>
                                                <li class="mb-2"> You can connect with the advertiser in the order chat.</li>
                                                <li class="mb-2"> You have a deadline and an established time for each order. Do not forget
                                                    to check it out!</li>
                                                <li class="mb-2"> Change the price or your web data up to once a month.</li>
                                                <li class="mb-2"> Contact with Support whenever you need it and we answer you in less than
                                                    24 hours.</li>
                                            </ul>
                                        </div>



                                    </div>
                                    <div class="col-12 ">
                                        <form action="{{ route('publishers.store.allSteps') }}" method="POST">
                                            @csrf

                                            <button type="submit" class="btn btn-success">Finish <i class="fa fa-arrow-right ms-1"
                                                    aria-hidden="true"></i></button>
                                        </form>

                                    </div>

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
