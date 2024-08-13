@extends('layouts.app')
@section('title')
Webs | {{ auth()->user()->role }}
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
Advertisers
@endslot
@slot('title')
Websites
@endslot
@endcomponent
<div class="row">
    <div class="col-12 py-3">
        <h3>Find the best webs for your marketing strategy</h3>
        <p>Unlock the potential of your marketing campaigns by discovering the perfect websites tailored to your needs.
            Use our advanced filtering options to narrow down your search and find the ideal platforms that align with
            your target audience, content type, and budget. Whether you're looking to increase brand awareness, drive
            traffic, or generate leads, our curated selection of websites will help you achieve your goals.</p>
    </div>



</div>
<div class="card px-4">
    <form action="" id="filerWebForm">
        <div class="row py-3">
            <div class="col-12 text-end">
                <a href="{{ route('advertiser.webs.list') }}" class="btn btn-dark"> <i class="fa fa-search me-1"
                        aria-hidden="true"></i>All Results</a>
            </div>
            <div class="col-12 py-3">
                <div class="input-group ">

                    <span class="input-group-text" id="inputGroup-sizing-default"><i class="fa fa-search"
                            aria-hidden="true"></i></span>
                    <input name="search_query" type="text" class="form-control"
                        placeholder="Search by URL, description, tag or region" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" onchange="submitForm()">
                </div>
            </div>
            {{-- Search by Country --}}
            <div class="col-sm-4">
                <div class="mb-3">
                    <label for="Select_Country">Search by Country
                    </label>
                    <select name="audience" class="Select_Country" onchange="submitForm()">
                        <option value="" disabled selected>Select an option</option>
                        @foreach (config('countries.countries') as $country)
                        <option value="{{ $country }}" {{ old('audience')==$country ? 'selected' : '' }}>
                            {{ $country }}</option>
                        @endforeach

                    </select>
                </div>

            </div>
            {{-- Search by categories --}}
            <div class="col-sm-4">
                <div class="mb-3">
                    <label for="Select_Country">Search by categories
                    </label>
                    <select name="categories" class="Select_Country" onchange="submitForm()">
                        <option value="" disabled selected>Select an option</option>
                        @foreach (config('categories.categories') as $category)
                        <option value="{{ $category['label'] }}">
                            {{ $category['label'] }}</option>
                        @endforeach

                    </select>
                </div>

            </div>
            {{-- Search by type of links admitted --}}
            <div class="col-sm-4">
                <div class="mb-3">
                    <label> Search by type of links admitted <span class="text-danger">*</span></label>
                    <select name="link_type" class="js-example-basic-single links_admitted" id="links_admitted"
                        onchange="submitForm()">
                        <option value="" disabled selected>Select an option</option>
                        <option value="Follow">Follow
                        </option>
                        <option value="No Follow">No
                            Follow</option>
                        <option value="Sponsored">
                            Sponsored</option>
                    </select>

                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3">
                    <div>
                        <label for="Website_Language"> Search by Language <span class="text-danger">*</span></label>
                    </div>
                    <select required class="js-example-basic-multiple" name="language" id="Website_Language"
                        onchange="submitForm()">
                        <option value="" disabled selected>Select a Language</option>
                        <option value="catalan">Catalán</option>
                        <option value="english">English</option>
                        <option value="esukera">Esukera</option>
                        <option value="french">French</option>
                        <option value="gallego">Gallego</option>
                        <option value="german">German</option>
                        <option value="italiano">Italiano</option>
                        <option value="portuguese">Portuguese</option>
                        <option value="spanish">Spanish</option>
                    </select>
                    @error('language')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- Min Price --}}
            <div class="col-sm-4">
                <label>Enter Min Price </label>
                <div class="input-group">

                    <span class="input-group-text" id="inputGroup-sizing-default">Min.price</span>
                    <input name="min_price" type="number" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" onchange="submitForm()">
                </div>
            </div>
            {{-- Max Price --}}
            <div class="col-sm-4">
                <label>Enter Max Price </label>
                <div class="input-group">

                    <span class="input-group-text" id="inputGroup-sizing-default">Max.price</span>
                    <input name="max_price" type="number" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" onchange="submitForm()">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3">
                    <label>Search by Sponsorship notification </label>
                    <select name="sponsorship" class="delicated_topics" onchange="submitForm()">
                        <option value="">Select an options</option>

                        <option value="Always">Always
                        </option>
                        <option value="Only if its is noticed">Only if its is
                            noticed</option>

                    </select>

                </div>
            </div>
        </div>
    </form>
</div>
<div class="row mt-4">

    @if ($website->isEmpty())
    <div class="col-12">
        <div class="alert alert-info mt-4">
            No results found.
        </div>

    </div>
    @else
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
        <div class="card border btn-soft-success weblistCard ">
            <div class="card-header d-flex justify-content-between bg-success-subtle ">
                <a style="font-weight: 700" href="{{ $site->web_url }}" class="card-title mb-0 text-dark">{{
                    $site->web_url }}</a>
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
                                    aria-hidden="true "></i> {{ $site->language }}</p>
                            <p><i class="fa fa-globe me-1" aria-hidden="true "></i> {{ $site->audience }}</p>
                        </div>
                        <div class="d-flex justify-content-between ">
                            <div>
                                <p><i style="font-size: 17px;" class="fa fa-link me-1 text-success "
                                        aria-hidden="true "></i>{{ $site->post_link }}
                                    links
                                    max./post</p>
                            </div>
                            <div>
                                <p class="mb-0"><i style="font-size: 17px;" class="fa bx bxs-spa text-warning me-1"
                                        aria-hidden="true "></i>
                                    <span class="badge bg-primary-subtle text-primary badge-border">{{ $site->link_type
                                        }}</span>
                                </p>
                                <p>indicated: Yes</p>
                            </div>
                        </div>

                        <p class="mb-1"><i style="color: rgb(75, 77, 0)" class="bx bx-code-block me-1"
                                aria-hidden="true"></i>{{ $site->link_type }}</p>
                        <p class="mb-1"><i class="bx bxs-home-circle text-secondary me-1 "
                                aria-hidden="true"></i>Publishes in the
                            main page:
                            @if ($site->publish_web)
                            <span class="badge bg-dark-subtle text-dark badge-border"> Yes</span>
                            @else
                            <span class="badge bg-info-subtle text-info badge-border"> No</span>
                            @endif
                        </p>

                        <p class="mb-1"><i style="color: rgb(122, 95, 7)" class="bx bx-wind  me-1"
                                aria-hidden="true"></i>Publishes in
                            related
                            categories:
                            @if ($site->publish_categories)
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
                            {{ $site->web_description }} </p>
                        <p><i class="fa fa-calendar-o me-1 text-primary" aria-hidden="true"></i>

                            In Publisuites from
                            <br>
                            <span class="badge bg-primary-subtle text-primary badge-border">
                                {{ \Carbon\Carbon::parse($site->created_at)->format('F Y d') }}</span>

                        </p>
                    </div>
                    <div class="text-end">
                        <a style="font-size:20px; color:white;" href="javascript:void(0)"
                            onclick="addFavourite('{{ $site->id }}')">
                            <i id="heart-{{ $site->id }}"
                                class="fa {{ $site->isFavourite() ? 'fa-heart text-danger' : 'fa-heart-o text-dark' }}"
                                aria-hidden="true"></i>
                        </a>
                    </div>
                    <hr>
                    <div class="col-12 d-flex justify-content-between ">
                        <a class="btn btn-soft-success"
                            href="javascript:void(0);">
                            <i class="fa fa-eye"></i> More details
                        </a>
                        <a class="btn btn-dark" href="javascript:void(0);"
                            onclick="purchaseWeb({{ $site->id }}, '{{ $site->normal_price }}')">
                            <span class="">$</span>{{ $site->normal_price }}
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
                    url: "{{ route('advertiser.add.favourite') }}",
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
