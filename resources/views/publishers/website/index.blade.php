@extends('layouts.app')
@section('title')
Website | Publishers
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
Website
@endslot
@endcomponent
<div class="row">
    <div class="col-8 py-3">

        <!-- Secondary Alert -->






        @if(session('error'))
        <!-- Danger Alert -->
        <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
            <strong>Error</strong> - {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss=" alert" aria-label="Close"></button>
        </div>
        @elseif(session('delete'))
        <div class="alert alert-danger alert-dismissible bg-danger text-white alert-label-icon fade show" role="alert">
            <i class="ri-check-double-line label-icon"></i><strong> {{ session('delete') }}</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="">Websites List</h3>

                <a href="{{ route('publishers.add.websiteStep1') }}" class="btn btn-primary waves-effect waves-light">
                    <i class="fa fa-plus"></i> Add web</a>
            </div>
            <div class="card-body">
                <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                    <thead>
                        <tr>

                            <th>SR No.</th>
                            <th>URL </th>
                            <th>Categories</th>
                            <th>Delicated topics</th>
                            <th>Links per post </th>
                            <th>Links admitted</th>
                            <th>Website Status </th>
                            {{-- <th>DR </th>
                            <th>DA </th>
                            <th>PA </th>
                            <th>CF </th>
                            <th>TF </th>
                            <th>Credit </th> --}}
                            {{-- <th>Analytics </th>
                            <th>Status </th> --}}
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
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
                        <tr>

                            <td>{{ $loop->iteration }}
                            <td>{{ $site->web_url }}</td>
                            <td>
                                <button style="padding: 0px; width:21px; height:21px;" type="button"
                                    class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="right"
                                    title="{{ $categoriesList }}">
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                </button>


                            </td>
                            <td> <button style="padding: 0px; width:21px; height:21px;" type="button"
                                    class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="right"
                                    title="{{ $delicatedTopicsList }}">
                                    <i class="fa fa-ban" aria-hidden="true"></i>
                                </button></td>

                            <td>{{ $site->post_link }}
                            </td>
                            <td><button style="padding: 0px; width:21px; height:21px;" type="button"
                                    class="btn btn-dark" data-bs-toggle="tooltip" data-bs-placement="right"
                                    title="{{ $site->link_type }}">
                                    <i class="fa fa-exclamation" aria-hidden="true"></i>
                                </button></td>
                                <td id="status-{{ $site->id }}">
                                    @if ($site->website_status == 'pending')
                                        <span style="font-size: 12px;"
                                            class="badge bg-primary">{{ $site->website_status }}</span>
                                    @elseif($site->website_status == 'approve')
                                        <span style="font-size: 12px;"
                                            class="badge bg-success">{{ $site->website_status }}</span>
                                    @elseif($site->website_status == 'rejected')
                                        <span style="font-size: 12px;"
                                            class="badge bg-danger">{{ $site->website_status }}</span>
                                    @endif

                                </td>

                            <td>
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">

                                        <li>
                                            <form action="{{ route('publishers.websiteDelete', $site->id) }}"
                                                method="POST">
                                                @csrf

                                                <button type="submit" class="dropdown-item edit-item-btn"
                                                    onclick="return confirm('Are you sure you want to delete this website?');">
                                                    <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                    Delete
                                                </button>
                                            </form>

                                        </li>
                                        <li class="dropdown-item ">
                                            <a href="{{ route('publishers.website.detail', ['encodedId' => base64_encode($site->id)]) }}">
                                                <i class="fa fa-eye me-2" aria-hidden="true"></i>View
                                            </a>

                                        </li>
                                    </ul>
                                </div>
                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--end col-->
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
