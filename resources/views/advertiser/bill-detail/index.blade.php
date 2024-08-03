@extends('layouts.app')
@section('title')
Project | {{ auth()->user()->role }}
@endsection
@section('css')
<style>

</style>
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1')
Wallet
@endslot
@slot('title')
Add Bill Detail
@endslot
@endcomponent
<div class="row">
    <div class="col-lg-10 ">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>Add credit</h4>
                <div>
                    <a href="{{ route('advertiser.wallet') }}" class="btn btn-dark"> <i class="fa fa-arrow-left"></i> back</a>
                </div>
            </div>
            <div class="card-body">


                    <div class="row">
                        {{-- Amount --}}
                        <div class="col-12 mb-4">
                            <label>Amount </label>
                            <div class="input-group">

                                <span class="input-group-text" id="inputGroup-sizing-default">$</span>
                                <input name="min_price" type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>
                        </div>
                        <div class="col-12 mb-4">
                            <!-- Accordions with Plus Icon -->
                            <div class="accordion custom-accordionwithicon-plus" id="accordionWithplusicon">
                                <div class="accordion-item material-shadow">
                                    <h2 class="accordion-header" id="accordionwithplusExample1">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_plusExamplecollapse1" aria-expanded="true" aria-controls="accor_plusExamplecollapse1">
                                            Do you have a promotional coupon?
                                        </button>
                                    </h2>
                                    <div id="accor_plusExamplecollapse1" class="accordion-collapse collapse " aria-labelledby="accordionwithplusExample1" data-bs-parent="#accordionWithplusicon">
                                        <div class="accordion-body">
                                            <div class="input-group">

                                                <input name="min_price" type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                                <span class="input-group-text" id="inputGroup-sizing-default">Apply coupon</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        {{-- Select your payment method --}}
                        <div class="col-12 ">
                            <label for="Project_Objectives">Select your payment method<span class="text-danger" style="font-size: 16px;">
                                    *</span></label>
                        </div>
                        <div class="col-12 d-flex ">
                            <div class="mb-3 me-4">

                                <input name="track_device" type="radio" class="btn-check" id="PayPal" value="desktop" {{ old('track_device')=='desktop' ? 'checked' : '' }}>
                                <label class="btn btn-outline-white" for="PayPal">
                                    <div>
                                       <img style="width: 133px; height:133px;" class="img-fluid" src="{{ URL::asset('build/images/pay-bill/paypal.png') }}" alt="not">
                                    </div>
                                   <div>

                                    <strong style="color: black">PayPal</strong>
                                   </div>
                                </label>

                            </div>
                            <div class="mb-3 ms-3">

                                <input name="track_device" type="radio" class="btn-check" id="Credit_Card" value="desktop" {{ old('track_device')=='desktop' ? 'checked' : '' }}>
                                <label class="btn btn-outline-white" for="Credit_Card">
                                    <div>
                                       <img style="width: 133px; height:133px;" class="img-fluid" src="{{ URL::asset('build/images/pay-bill/stripe.png') }}" alt="not">
                                    </div>
                                   <div>
                                    <strong style="color: black">Credit Card</strong>
                                   </div>
                                </label>

                            </div>
                            <div class="mb-3 ms-3">

                                <input name="track_device" type="radio" class="btn-check" id="Bank_Transfer" value="desktop" {{ old('track_device')=='desktop' ? 'checked' : '' }}>
                                <label class="btn btn-outline-white" for="Bank_Transfer">
                                    <div>
                                       <img style="width: 133px; height:133px;" class="img-fluid" src="{{ URL::asset('build/images/pay-bill/bank-transfer-2.png') }}" alt="not">
                                    </div>
                                   <div>
                                    <strong style="color: black">Bank Transfer</strong>
                                   </div>
                                </label>

                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <button type="" class="btn btn-primary btn-lg">Save</button>
                        </div>
                    </div>
              
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

@endsection

