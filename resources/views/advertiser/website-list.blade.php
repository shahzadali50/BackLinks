@extends('layouts.app')
@section('title')
Webs | {{ auth()->user()->role }}
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1')
Advertisers
@endslot
@slot('title')
Websites
@endslot
@endcomponent
<div class="row">
    <div class="col-12 py-3">
        <h3>Find the best webs for your marketing strategy</h3>
        <p>Use the following filters to find the website that best fits your needs</p>
    </div>

</div>
<form action="">
    <div class="row py-3">
        <div class="col-sm-6">
            <div class="mb-3">
                <label for="Select_Country">Search by Country
                       </label>
                <select name="audience" class="Select_Country">
                    <option value="" >Select Country </option>

                    @foreach(config('countries.countries') as $country)
                    <option value="{{ $country }}" {{ old('audience')==$country ? 'selected' : '' }}>{{
                        $country }}</option>

                    @endforeach

                </select>
            </div>

        </div>
        <div class="col-sm-6">
            <div class="mb-3">
                <label for="Select_Country">Search by categories
                       </label>
                <select name="categories[]" class="Select_Country">
                    <option value="" >Select categories </option>
                    @foreach(config('categories.categories') as $category)
                    <option value="{{ $category['label'] }}">
                        {{ $category['label'] }}</option>

                    @endforeach

                </select>
            </div>

        </div>
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary "><i class="fa fa-search me-1" aria-hidden="true"></i>Filter Webs</button>
        </div>
    </div>
</form>
<div class="row">




    @foreach ($website as $site)
    @php
    // Decode categories and dedicated topics JSON
    $categories = json_decode($site->categories, true);
    $categoriesList = is_array($categories) ? implode(', ', $categories) : $categories;

    $delicatedTopics = json_decode($site->delicated_topics, true);
    // Convert array to comma-separated list, or just display the value if not an array
    $delicatedTopicsList = is_array($delicatedTopics)
        ? implode(', ', $delicatedTopics)
        : $delicatedTopics;
@endphp
    <div class="col-lg-6">
        <div class="card border card-border-info ">
            <div class="card-header d-flex justify-content-between ">
                <a href="{{ $site->web_url }}" class="card-title mb-0">{{ $site->web_url }}</a>
                <div>
                    <span class="badge bg-success align-middle fs-10"> <i class="fa fa-laptop me-1" aria-hidden="true"></i>Websites</span>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-7">
                        <div class="d-flex justify-content-between ">
                            <p class=""><i class="fa fa-globe me-1" aria-hidden="true "></i>Italt</p>
                            <p><i class="fa fa-globe me-1" aria-hidden="true "></i> {{ $site->audience }}</p>
                        </div>
                        <div class="d-flex justify-content-between ">
                           <div>
                            <p><i class="fa fa-link me-1" aria-hidden="true "></i>{{ $site->post_link }} links max./post</p>
                           </div>
                           <div>
                            <p class="mb-0"><i class="fa fa-link me-1" aria-hidden="true "></i>"{{ $site->link_type }} "</p>
                           <p>indicated: Yes</p>
                           </div>
                        </div>
                        <p class="mb-1"><i class="fa fa-code me-1" aria-hidden="true"></i>{{ $site->link_type }}</p>
                        <p class="mb-1"><i class="fa fa-home me-1" aria-hidden="true"></i>Publishes in the main page:
                             @if($site->publish_web)
                             Yes
                             @else
                             No
                             @endif
                        </p>
                        <p class="mb-1"><i class="fa fa-tag me-1" aria-hidden="true"></i>Publishes in related categories:
                            @if($site->publish_categories)
                            Yes
                            @else
                            No
                            @endif

                        </p>
                        <p class="mt-3"><i class="fa fa-table text-primary me-1" aria-hidden="true"></i>{{ $categoriesList }}</p>
                        <p class="mt-3"><i class="fa fa-exclamation-circle text-danger me-1" aria-hidden="true"></i> {{    $delicatedTopicsList }}</p>

                    </div>
                    <div class="col-md-5">
                        <p> {{ $site->web_description }} </p>
                        <p><i class="fa fa-calendar-o me-1" aria-hidden="true"></i>In Publisuites from <br> {{ \Carbon\Carbon::parse($site->created_at)->format('F Y d') }}

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach


    @endsection
    @section('script')
<script>
    $(document).ready(function() {
        $('.Project_Language').select2();
        $('.Select_Country').select2();
        $('.links_per_post').select2();
        $('.links_admitted').select2();
        $('.delicated_topics').select2();
        $('.js-example-basic-multiple').select2();
    });
</script>
@endsection
