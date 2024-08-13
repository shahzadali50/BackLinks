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
            Purchase Website list
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12 py-3">
          <div class="card p-4">
            <h3 class="text-dark">Your best website which you have purchased</h3>

          </div>
        </div>

    </div>

    <div class="row mt-4">

        @if ($websites->isEmpty())
            <div class="col-12">
                <div class="alert alert-dark mt-4">
                    <strong>You did not purchase any website
                        Please purchase website</strong>
                </div>

            </div>
        @else
        @foreach ($websites as $site)
        @php
            // Decode categories and dedicated topics JSON
            $categories = json_decode($site->categories, true);
            $categoriesList = is_array($categories) ? implode(', ', $categories) : $categories;

            $delicatedTopics = json_decode($site->delicated_topics, true);
            $delicatedTopicsList = is_array($delicatedTopics)
                ? implode(', ', $delicatedTopics)
                : $delicatedTopics;
        @endphp
        <div class="col-12">
            <div class="card border btn-soft-success weblistCard">
                <div class="card-header d-flex justify-content-between bg-success-subtle">
                    <a href="{{ $site->web_url }}" class="card-title mb-0 text-dark">{{ $site->web_url }}</a>
                    <div>
                        <span class="badge bg-success align-middle fs-10"><i class="fa fa-laptop me-1" aria-hidden="true"></i>Websites</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="d-flex justify-content-between">
                                <p><i style="font-size: 17px;" class="fa fa-globe me-1 text-info" aria-hidden="true"></i>{{ $site->language }}</p>
                                <p><i class="fa fa-globe me-1" aria-hidden="true"></i> {{ $site->audience }}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p><i style="font-size: 17px;" class="fa fa-link me-1 text-success" aria-hidden="true"></i>{{ $site->post_link }} links max./post</p>
                                </div>
                                <div>
                                    <p class="mb-0"><i style="font-size: 17px;" class="fa bx bxs-spa text-warning me-1" aria-hidden="true"></i>
                                        <span class="badge bg-primary-subtle text-primary badge-border">{{ $site->link_type }}</span>
                                    </p>
                                    <p>indicated: Yes</p>
                                </div>
                            </div>

                            <p class="mb-1"><i style="color: rgb(75, 77, 0)" class="bx bx-code-block me-1" aria-hidden="true"></i>{{ $site->link_type }}</p>
                            <p class="mb-1"><i class="bx bxs-home-circle text-secondary me-1" aria-hidden="true"></i>Publishes in the main page:
                                @if ($site->publish_web)
                                    <span class="badge bg-dark-subtle text-dark badge-border"> Yes</span>
                                @else
                                    <span class="badge bg-info-subtle text-info badge-border"> No</span>
                                @endif
                            </p>

                            <p class="mb-1"><i style="color: rgb(122, 95, 7)" class="bx bx-wind me-1" aria-hidden="true"></i>Publishes in related categories:
                                @if ($site->publish_categories)
                                    <span class="badge bg-secondary-subtle text-secondary badge-border"> Yes</span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary badge-border"> No</span>
                                @endif
                            </p>

                            <p class="mt-3"><i class="bx bx-category-alt text-primary me-1" aria-hidden="true"></i>
                                <span class="badge rounded-pill bg-dark-subtle text-dark">{{ $categoriesList }}</span>
                            </p>
                            <div class="d-flex align-items-start">
                                <i class="bx bxs-error-alt text-danger me-1" aria-hidden="true"></i>
                                <p style="border-radius: 10px" class="bg-info-subtle px-2">{{ $delicatedTopicsList }}</p>
                            </div>

                        </div>
                        <div class="col-md-5">
                            <p class="bg-dark-subtle px-2">{{ $site->web_description }}</p>
                            <p><i class="fa fa-calendar-o me-1 text-primary" aria-hidden="true"></i>
                                In Publisuites from
                                <br>
                                <span class="badge bg-primary-subtle text-primary badge-border">{{ \Carbon\Carbon::parse($site->created_at)->format('F Y d') }}</span>
                            </p>
                        </div>

                        <hr>
                        <div class="col-12 text-end">
                            <a style="background-color: #e2e5ed; color:black; font-weight:900" href="javascript:void(0);" class="btn ">
                               ${{ $site->normal_price }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

        @endif

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
            // purchaseWeb
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
            // addFavourite
            function addFavourite(id) {
                var fileId = id;
                // alert('Add Favourite'+fileId);
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('advertiser.purchase.web') }}",
                    data: {
                        'fileId': fileId,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
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
        </script>
    @endsection
