<!-- resources/views/advertiser/favourite-website.blade.php -->

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
                    <div class="card border card-border-info ">
                        <div class="card-header d-flex justify-content-between ">
                            <a href="{{ $favourite->website->web_url }}"
                                class="card-title mb-0">{{ $favourite->website->web_url }}</a>
                            <div>
                                <span class="badge bg-success align-middle fs-10"> <i class="fa fa-laptop me-1"
                                        aria-hidden="true"></i>Websites</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="d-flex justify-content-between ">
                                        <p class=""><i class="fa fa-globe me-1" aria-hidden="true "></i>Italt</p>
                                        <p><i class="fa fa-globe me-1" aria-hidden="true "></i>
                                            {{ $favourite->website->audience }}
                                        </p>
                                    </div>
                                    <div class="d-flex justify-content-between ">
                                        <div>
                                            <p><i class="fa fa-link me-1"
                                                    aria-hidden="true "></i>{{ $favourite->website->post_link }}
                                                links
                                                max./post</p>
                                        </div>
                                        <div>
                                            <p class="mb-0"><i class="fa fa-link me-1"
                                                    aria-hidden="true "></i>"{{ $favourite->website->link_type }} "</p>
                                            <p>indicated: Yes</p>
                                        </div>
                                    </div>
                                    <p class="mb-1"><i class="fa fa-code me-1"
                                            aria-hidden="true"></i>{{ $favourite->website->link_type }}</p>
                                    <p class="mb-1"><i class="fa fa-home me-1" aria-hidden="true"></i>Publishes in the
                                        main page:
                                        @if ($favourite->website->publish_web)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </p>
                                    <p class="mb-1"><i class="fa fa-tag me-1" aria-hidden="true"></i>Publishes in
                                        related
                                        categories:
                                        @if ($favourite->website->publish_categories)
                                            Yes
                                        @else
                                            No
                                        @endif

                                    </p>
                                    <p class="mt-3"><i class="fa fa-table text-primary me-1"
                                            aria-hidden="true"></i>{{ $categoriesList }}</p>
                                    <p class="mt-3"><i class="fa fa-exclamation-circle text-danger me-1"
                                            aria-hidden="true"></i> {{ $delicatedTopicsList }}</p>

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


                                    <span class="btn btn-warning">{{ $favourite->website->normal_price }}</span>
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
    </script>
@endsection
