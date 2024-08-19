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
    <div class="col-12 ">
        <div class="card">
            <div class="card-header ">
                <h4>Add credit</h4>

            </div>
            <div class="card-body">


                   <form action="{{ route('advertiser.credit.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        {{-- Amount --}}
                        <div class="col-12 mb-4">
                            <label for="Amount">Amount </label>
                            <div class="input-group">

                                <span class="input-group-text">$</span>
                                <input value="{{ old('amount') }}" id="Amount" name="amount" type="number" class="form-control" >

                            </div>
                            @error('amount')
                            <div class=" mt-1 alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                <i class="ri-error-warning-line label-icon"></i><strong>{{ $message }}</strong>
                            </div>
                            @enderror

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

                                                <input name="coupon" type="number" class="form-control" >
                                                <span class="input-group-text" >Apply coupon</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            @error('coupon')
                            <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                <i class="ri-error-warning-line label-icon"></i><strong>{{ $message }}</strong>
                            </div>
                            @enderror

                        </div>
                        {{-- Select your payment method --}}
                        <div class="col-12 ">
                            <label for="Project_Objectives">Select your payment method<span class="text-danger" style="font-size: 16px;">
                                    *</span></label>
                                    @error('payment_method')
                                    <div class=" mt-1 alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                        <i class="ri-error-warning-line label-icon"></i><strong>{{ $message }}</strong>
                                    </div>
                                    @enderror

                        </div>
                        <div class="col-12 d-flex">
                            <div class="mb-3 me-4">
                                <input name="payment_method" type="radio" class="btn-check" id="PayPal" value="PayPal" {{ old('payment_method') == 'PayPal' ? 'checked' : '' }}>
                                <label class="btn btn-outline-white" for="PayPal">
                                    <div>
                                        <img style="width: 133px; height: 133px;" class="img-fluid" src="{{ URL::asset('build/images/pay-bill/paypal.png') }}" alt="PayPal">
                                    </div>
                                    <div>
                                        <strong style="color: black">PayPal</strong>
                                    </div>
                                </label>
                            </div>

                            <div class="mb-3 ms-3">
                                <input name="payment_method" type="radio" class="btn-check" id="Stripe" value="Stripe" {{ old('payment_method') == 'Stripe' ? 'checked' : '' }}>
                                <label class="btn btn-outline-white" for="Stripe">
                                    <div>
                                        <img style="width: 133px; height: 133px;" class="img-fluid" src="{{ URL::asset('build/images/pay-bill/stripe.png') }}" alt="Credit Card">
                                    </div>
                                    <div>
                                        <strong style="color: black">Stripe</strong>
                                    </div>
                                </label>
                            </div>

                            <div class="mb-3 ms-3">
                                <input name="payment_method" type="radio" class="btn-check" id="Bank_Transfer" value="Bank_Transfer" {{ old('payment_method') == 'Bank Transfer' ? 'checked' : '' }}>
                                <label class="btn btn-outline-white" for="Bank_Transfer">
                                    <div>
                                        <img style="width: 133px; height: 133px;" class="img-fluid" src="{{ URL::asset('build/images/pay-bill/bank-transfer-2.png') }}" alt="Bank Transfer">
                                    </div>
                                    <div>
                                        <strong style="color: black">Bank Transfer</strong>
                                    </div>
                                </label>
                            </div>
                        </div>


                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-primary btn-lg">Save</button>

                                <a href="{{ route('advertiser.wallet') }}" class="btn btn-dark btn-lg ms-2"> <i class="fa fa-arrow-left"></i> back</a>

                        </div>
                    </div>
                   </form>

            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        @if(session('success'))
        Swal.fire({
                title: 'Thank You 👍',
                text: '{{ session('success') }}',
                icon: 'success'
            });
        @endif

    })
</script>

@endsection

