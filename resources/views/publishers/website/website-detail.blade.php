@extends('layouts.app')
@section('title')
Website-Detail | Publishers
@endsection
@section('css')
<!--datatable css-->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet"
    type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1')
Publishers
@endslot
@slot('title')
Website-Detail
@endslot
@endcomponent
<div class="row">
   @foreach ($website as $site)
                @php
                    // Decode categories and dedicated topics JSON
                    // $categories = json_decode($site->categories, true);
                    // $categoriesList = is_array($categories) ? implode(', ', $categories) : $categories;

                    // $delicatedTopics = json_decode($site->delicated_topics, true);
                    // Convert array to comma-separated list, or just display the value if not an array
                    // $delicatedTopicsList = is_array($delicatedTopics)
                    //     ? implode(', ', $delicatedTopics)
                    //     : $delicatedTopics;
                @endphp
                <div class="col-lg-6">
                    <div class="card border btn-soft-success weblistCard ">
                        <div class="card-header d-flex justify-content-between bg-success-subtle ">
                            {{-- <a href="{{ $site->web_url }}" class="card-title mb-0 text-dark">{{ $site->web_url }}</a> --}}
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
                                            <p class="mb-0"><i style="font-size: 17px;"
                                                    class="fa bx bxs-spa text-warning me-1" aria-hidden="true "></i>
                                                <span
                                                    class="badge bg-primary-subtle text-primary badge-border">{{ $site->link_type }}</span>
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

                                    <p class="mt-3"><i class="bx bx-category-alt text-primary me-1"
                                            aria-hidden="true"></i>
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
                                    <p class="bg-dark-subtle px-2"> {{ $site->web_description }} </p>
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
                                <div class="col-12 text-end">
                                    <a style="font-size:16px"  href="javascript:void(0);"
                                        onclick="purchaseWeb({{ $site->id }}, '{{ $site->normal_price }}')">
                                        <span class="">$</span>{{ $site->normal_price }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
</div>
@endsection
@section('script')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>
<script>
      $(document).ready(function() {
        @if (session('success'))
            Swal.fire({
                title: 'Thank You 👍',
                text: '{{ session('success') }}',
                icon: 'success'
            });
        @endif
    });
</script>
@endsection
