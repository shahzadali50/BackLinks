@extends('layouts.app')
@section('title') Explore now @endsection
@push('css')
<link href="{{ URL::asset('build/libs/nouislider/nouislider.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
@component('components.breadcrumb')
@slot('li_1') NFT Marketplace @endslot
@slot('title')Explore Now" @endslot
@endcomponent
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1">Explore Product</h5>
                    <div>
                        <a class="btn btn-success" data-bs-toggle="collapse" href="#collapseExample"><i class="ri-filter-2-line align-bottom"></i> Filters</a>
                    </div>
                </div>
                <div class="collaps show" id="collapseExample">
                    <div class="row row-cols-xxl-5 row-cols-lg-3 row-cols-md-2 row-cols-1 mt-3 g-3">
                        <div class="col">
                            <h6 class="text-uppercase fs-12 mb-2">Search</h6>
                            <input type="text" class="form-control" placeholder="Search product name" autocomplete="off" id="searchProductList">
                        </div>
                        <div class="col">
                            <h6 class="text-uppercase fs-12 mb-2">Select Category</h6>
                            <select class="form-control" data-choices name="select-category" data-choices-search-false id="select-category">
                                <option value="">Select Category</option>
                                <option value="Artwork">Artwork</option>
                                <option value="3d Style">3d Style</option>
                                <option value="Photography">Photography</option>
                                <option value="Collectibles">Collectibles</option>
                                <option value="Crypto Card">Crypto Card</option>
                                <option value="Games">Games</option>
                                <option value="Music">Music</option>
                            </select>
                        </div>
                        <div class="col">
                            <h6 class="text-uppercase fs-12 mb-2">File Type</h6>
                            <select class="form-control" data-choices name="file-type" data-choices-search-false id="file-type">
                                <option value="">File Type</option>
                                <option value="jpg">Images</option>
                                <option value="mp4">Video</option>
                                <option value="mp3">Audio</option>
                                <option value="gif">Gif</option>
                            </select>
                        </div>
                        <div class="col">
                            <h6 class="text-uppercase fs-12 mb-2">Sales Type</h6>
                            <select class="form-control" data-choices name="all-sales-type" data-choices-search-false id="all-sales-type">
                                <option value="">All Sales Type</option>
                                <option value="On Auction">On Auction</option>
                                <option value="Has Offers">Has Offers</option>
                            </select>
                        </div>
                        <div class="col">
                            <h6 class="text-uppercase fs-12 mb-4">Price</h6>
                            <div class="slider" id="range-product-price"></div>
                            <input class="form-control" type="hidden" id="minCost" value="0" />
                            <input class="form-control" type="hidden" id="maxCost" value="1000" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('script')

<!-- nouisliderribute js -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="{{ URL::asset('build/libs/nouislider/nouislider.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/wnumb/wNumb.min.js') }}"></script>

<script src="{{ URL::asset('build/js/pages/apps-nft-explore.init.js') }}"></script>

<script src="{{ URL::asset('build/js/app.js') }}"></script>

@endsection
