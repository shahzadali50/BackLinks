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

         <div class="alert alert-secondary alert-dismissible bg-secondary text-white alert-label-icon fade show" role="alert">
             <i class="ri-check-double-line label-icon"></i> <strong>Success</strong> - Step 3: Data has been saved successfully.
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
    <div class="col-md-10">
        <div class="card">
            <div class="row p-5">
                {{-- Code --}}
                <div class="col-md-12">
                    <div class="card p-3" style="background-color: #d6d6d657">
                       <ul>
                        <li class="mb-2">You have 48 hours to accept or reject orders.</li>
                        <li class="mb-2"> Once the order is finished, you can ask for you payment. Get it in only 10 working days.</li>
                        <li class="mb-2"> You can connect with the advertiser in the order chat.</li>
                        <li class="mb-2">  You have a deadline and an established time for each order. Do not forget to check it out!</li>
                        <li class="mb-2"> Change the price or your web data up to once a month.</li>
                        <li class="mb-2"> Contact with Support whenever you need it and we answer you in less than 24 hours.</li>
                       </ul>
                    </div>



                </div>
                <div class="col-12 text-end">
                    <form action="{{ route('publishers.store.allSteps') }}" method="POST">
                        @csrf

                        <button type="submit" class="btn btn-success">Finish <i class="fa fa-arrow-right ms-1" aria-hidden="true"></i></button>
                    </form>

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
                    <div class="circle-pasos circle-activep"><i class="fa fa-check" aria-hidden="true"></i></div>
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
                    <div class="circle-pasos circle-activep"><i class="fa fa-check" aria-hidden="true"></i></div>
                    <div class="line-pasos-donep"></div>
                </div>
                <div class="texto-pasos">
                    <p class="p-pasos-active">Finished</p>
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
