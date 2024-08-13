<!-- resources/views/advertiser/favourite-website.blade.php -->

@extends('layouts.app')

@section('title')
Webs | {{ auth()->user()->role }}
@endsection
@section('css')
<style>
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
Advertisers
@endslot
@slot('title')
Favourite Websites
@endslot
@endcomponent
<div class="row">
    <div class="col-12 py-3">
        <div class="alert alert-dark" role="alert">
            <strong>Favourites best websites for your marketing strategy</strong>
        </div>
    </div>
</div>
<div class="row mt-4">
    @if ($favouriteWebsites->isEmpty())
    <div class="col-12">

        <p>No Favourite Websites Added</p>
    </div>
    @else
    @foreach ($favouriteWebsites as $favourite)
    @php
    // Decode categories and dedicated topics JSON
    $categories = json_decode($favourite->website->categories, true);
    $categoriesList = is_array($categories) ? implode(', ', $categories) : $categories;

    $delicatedTopics = json_decode($favourite->website->delicated_topics, true);
    $delicatedTopicsList = is_array($delicatedTopics)
    ? implode(', ', $delicatedTopics)
    : $delicatedTopics;
    @endphp
    <div class="col-lg-6">
        <div class="card border card-border-info weblistCard ">
            <div class="card-header d-flex justify-content-between ">
                <a href="{{ $favourite->website->web_url }}" class="card-title mb-0">{{ $favourite->website->web_url
                    }}</a>
                <div>
                    <span class="badge bg-success align-middle fs-10"> <i class="fa fa-laptop me-1"
                            aria-hidden="true"></i>Websites</span>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-7">
                        <div class="d-flex justify-content-between ">
                            <p class=""><i style="font-size: 17px;" class="fa fa-language me-1 text-info"
                                    aria-hidden="true "></i>{{ $favourite->website->language }}</p>
                            <p><i class="fa fa-globe me-1" aria-hidden="true "></i>
                                {{ $favourite->website->audience }}
                            </p>
                        </div>
                        <div class="d-flex justify-content-between ">
                            <div>
                                <p><i class="fa fa-link me-1 text-success " aria-hidden="true "></i>{{
                                    $favourite->website->post_link }}
                                    links
                                    max./post</p>
                            </div>
                            <div>
                                <p class="mb-0"><i class="fa bx bxs-spa text-warning me-1" aria-hidden="true "></i>"{{
                                    $favourite->website->link_type }} "</p>
                                <p>indicated: Yes</p>
                            </div>
                        </div>
                        <p class="mb-1"><i style="color: rgb(75, 77, 0)" class="bx bx-code-block me-1"
                                aria-hidden="true"></i>{{ $favourite->website->link_type }}</p>
                        <p class="mb-1"><i class="bx bxs-home-circle text-secondary me-1 "
                                aria-hidden="true"></i>Publishes in the
                            main page:
                            @if ($favourite->website->publish_web)
                            <span class="badge bg-dark-subtle text-dark badge-border"> Yes</span>
                            @else
                            <span class="badge bg-info-subtle text-info badge-border"> No</span>
                            @endif
                        </p>
                        <p class="mb-1"><i style="color: rgb(122, 95, 7)" class="bx bx-wind  me-1"
                                aria-hidden="true"></i>Publishes in
                            related
                            categories:
                            @if ($favourite->website->publish_categories)
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

                    </div>
                    <div class="col-md-5">
                        <p> {{ $favourite->website->web_description }} </p>
                        <p><i class="fa fa-calendar-o me-1" aria-hidden="true"></i>In Publisuites from <br>
                            {{ \Carbon\Carbon::parse($favourite->website->created_at)->format('F Y d') }}

                        </p>
                    </div>
                    <div class="text-end">
                        <a style="font-size:20px; color:white;" href="javascript:void(0)"
                            onclick="addFavourite('{{ $favourite->website->id }}')">
                            <i id="heart-{{ $favourite->website->id }}"
                                class="fa {{ $favourite->website->isFavourite() ? 'fa-heart text-danger' : 'fa-heart-o text-dark' }}"
                                aria-hidden="true"></i>
                        </a>
                    </div>
                    <hr>
                    <div class="col-12 text-end">
                        <a style="font-size:16px" href="javascript:void(0);"
                        onclick="purchaseWeb({{ $favourite->website->id }}, '{{ $favourite->website->normal_price }}')">
                        <span class="">$</span>{{ $favourite->website->normal_price }}
                    </a>
                        {{-- <span class="btn btn-warning">{{ $favourite->website->normal_price }}</span> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
            $('.Project_Language').select2({});
            $('.Select_Country').select2();
            $('.links_per_post').select2();
            $('.links_admitted').select2();
            $('.delicated_topics').select2();
            $('.js-example-basic-multiple').select2();
        });

        function submitForm() {
            document.getElementById('filerWebForm').submit();
        }

        function addFavourite(id) {
            var fileId = id;
            // alert('Add Favourite'+fileId);
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('advertiser.add.favourite') }}",
                data: {
                    'fileId': fileId,
                    '_token': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        $('#resetPasswordModal').modal('hide');
                        Swal.fire({
                            title: "Thank You 👍",
                            text: response.message,
                            icon: "success"
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Wrong",
                            text: response.message
                        });
                    }
                    var icon = $('#heart-' + fileId);
                    if (response.message === 'Website added to favourite') {
                        icon.removeClass('fa-heart-o text-dark ').addClass('fa-heart text-danger');
                    } else if (response.message === 'Website removed from favourite') {
                        icon.removeClass('fa-heart text-danger').addClass('fa-heart-o text-dark');
                    }
                }
            })


        }
        function purchaseWeb(id, normalPrice) {
                // var webId = id;
                // var price = normalPrice;
                // alert('webId = ' + webId + ' price =' + price);
                Swal.fire({
                    title: "Are you sure?",
                    text: "Are you sure you want  to purchase this website.",
                    icon: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, purchase it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Proceed with the AJAX request if confirmed
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "{{ route('advertiser.purchase.web') }}",
                            data: {
                                'webId': id,
                                'price': normalPrice,
                                '_token': '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) { // Checks if response.success is true
                                    Swal.fire({
                                        title: "Thank You 👍",
                                        text: response.message,
                                        icon: "success"
                                    });
                                } else {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Wrong",
                                        text: response.message
                                    });
                                }
                            },
                            error: function(xhr) {
                                let message = 'Something went wrong!';
                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                    message = xhr.responseJSON.message;
                                }
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Wrong',
                                    text: message,
                                });
                            }
                        });
                    }
                });
            }
</script>
@endsection
