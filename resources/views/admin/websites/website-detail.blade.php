@extends('layouts.app')
@section('title')
Website-List | {{ auth()->user()->role }}
@endsection
@section('css')
<style>
    .weblistCard:hover {
        box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
    }

    .weblistCard p {
        font-size: 14px;
    }

    .weblistCard i {
        font-size: 17px !important;

    }
</style>
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1')
Admin
@endslot
@slot('title')
Website Detail
@endslot
@endcomponent


<div class="row mt-4">

    @php
    // Decode categories and dedicated topics JSON
    $categories = json_decode($website->categories, true);
    $categoriesList = is_array($categories) ? implode(', ', $categories) : $categories;

    $delicatedTopics = json_decode($website->delicated_topics, true);
    // Convert array to comma-separated list, or just display the value if not an array
    $delicatedTopicsList = is_array($delicatedTopics)
    ? implode(', ', $delicatedTopics)
    : $delicatedTopics;
    @endphp
    <div class="col-12">
        <div class="card border btn-soft-success weblistCard ">
            <div class="card-header d-flex justify-content-between bg-success-subtle ">
                <a style="font-weight: 700" href="{{ $website->web_url }}" class="card-title mb-0 text-dark">{{
                    $website->web_url }}</a>
                <div>
                    <span class="badge bg-success align-middle fs-10"> <i class="fa fa-laptop me-1"
                            aria-hidden="true"></i>Websites</span>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-7">
                        <div class="d-flex justify-content-between ">
                            <p><i style="font-size: 17px;" class="fa fa-language me-1 text-info"
                                    aria-hidden="true "></i> {{ $website->language }}</p>
                            <p><i class="fa fa-globe me-1" aria-hidden="true "></i> {{ $website->audience }}</p>
                        </div>
                        <div class="d-flex justify-content-between ">
                            <div>
                                <p><i style="font-size: 17px;" class="fa fa-link me-1 text-success "
                                        aria-hidden="true "></i>{{ $website->post_link }}
                                    links
                                    max./post</p>
                            </div>
                            <div>
                                <p class="mb-0"><i style="font-size: 17px;" class="fa bx bxs-spa text-warning me-1"
                                        aria-hidden="true "></i>
                                    <span class="badge bg-primary-subtle text-primary badge-border">{{ $website->link_type
                                        }}</span>
                                </p>
                                <p>indicated: Yes</p>
                            </div>
                        </div>

                        <p class="mb-1"><i style="color: rgb(75, 77, 0)" class="bx bx-code-block me-1"
                                aria-hidden="true"></i>{{ $website->link_type }}</p>
                        <p class="mb-1"><i class="bx bxs-home-circle text-secondary me-1 "
                                aria-hidden="true"></i>Publishes in the
                            main page:
                            @if ($website->publish_web)
                            <span class="badge bg-dark-subtle text-dark badge-border"> Yes</span>
                            @else
                            <span class="badge bg-info-subtle text-info badge-border"> No</span>
                            @endif
                        </p>

                        <p class="mb-1"><i style="color: rgb(122, 95, 7)" class="bx bx-wind  me-1"
                                aria-hidden="true"></i>Publishes in
                            related
                            categories:
                            @if ($website->publish_categories)
                            <span class="badge bg-secondary-subtle text-secondary badge-border"> Yes</span>
                            @else
                            <span class="badge bg-secondary-subtle text-secondary badge-border"> No</span>
                            @endif

                        </p>

                        <p class="mt-3"><i class="bx bx-category-alt text-primary me-1" aria-hidden="true"></i>
                            <span class="badge rounded-pill bg-dark-subtle text-dark">
                                {{ $categoriesList }}</span>

                        </p>
                        <div class="d-flex align-items-start">
                            <i class="bx bxs-error-alt text-danger me-1" aria-hidden="true"></i>
                            <p style="border-radius: 10px" class="bg-info-subtle px-2">
                                {{ $delicatedTopicsList }}</p>
                        </div>

                        </p>

                    </div>
                    <div class="col-md-5">

                        <p style="border-radius: 8px;" class="bg-dark-subtle px-2">
                            {{ $website->web_description }} </p>
                        <p><i class="fa fa-calendar-o me-1 text-primary" aria-hidden="true"></i>

                            In Publisuites from
                            <br>
                            <span class="badge bg-primary-subtle text-primary badge-border">
                                {{ \Carbon\Carbon::parse($website->created_at)->format('F Y d') }}</span>

                        </p>
                    </div>

                    <hr>
                    <div class="col-12 text-end">

                        <p class="btn btn-dark">
                            <span class="">$</span>{{ $website->normal_price }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @endsection


    @section('script')
    @endsection
