@extends('layouts.app')
@section('title')
Website | Admin
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
Admin
@endslot
@slot('title')
Website List
@endslot
@endcomponent
<div class="row">
    <div class="col-12">
        <a href="{{ route('admin.website.list') }}"
            class="btn btn-outline-primary {{ request()->routeIs('admin.website.list') ? 'active' : '' }}"><i
                class="fa fa-search me-1" aria-hidden="true"></i>All Results</a>
        <a href="{{ route('admin.websites.pending') }}"
            class="btn btn-outline-primary {{ request()->routeIs('admin.websites.pending') ? 'active' : '' }}"><i
                class="fa fa-ravelry me-1" aria-hidden="true"></i>Pending</a>
        <a href="{{ route('admin.website.rejected') }}"
            class="btn btn-outline-primary {{ request()->routeIs('admin.website.rejected') ? 'active' : '' }}"><i
                class="fa fa-ban me-1" aria-hidden="true"></i>Rejected</a>
        <a href="{{ route('admin.websites.approve') }}"
            class="btn btn-outline-primary {{ request()->routeIs('admin.websites.approve') ? 'active' : '' }}"><i
                class="fa fa-check me-1" aria-hidden="true"></i>Approve</a>
    </div>
    <div class="card px-4 mt-4">
        <form action="" id="filerWebForm">
            <div class="row py-3">

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

    <!-- Secondary Alert -->

    @if (session('success'))
    <div class="col-12">
        <div class="alert alert-secondary alert-dismissible bg-secondary text-white alert-label-icon fade show"
            role="alert">
            <i class="ri-check-double-line label-icon"></i>
            <strong>Success</strong> - {{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @elseif(session('error'))
    <!-- Danger Alert -->
    <div class="col-12">
        <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
            <strong>Error</strong> - {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss=" alert" aria-label="Close"></button>
        </div>
    </div>
    @elseif(session('delete'))
    <div class="col-12">
        <div class="alert alert-danger alert-dismissible bg-danger text-white alert-label-icon fade show" role="alert">
            <i class="ri-check-double-line label-icon"></i><strong> {{ session('delete') }}</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    @if ($websites->isEmpty())
    <div class="col-12">
        <div class="alert alert-info mt-4">
            Sorry! 🛑 No results found.
        </div>

    </div>
    @endif
    <div class="col-12">
        <div class="card">
            <div class="card-header ">
                <h3 class="">Websites List</h3>

            </div>
            <div class="card-body">
                <table id="scroll-horizontal" class="table nowrap align-middle view_orders_tb" style="width:100%">
                    <thead>
                        <tr>

                            <th>SR No.</th>
                            <th>User_Email</th>
                            <th>URL </th>
                            <th>Categories</th>
                            <th>Delicated topics</th>
                            {{-- <th>Links per post </th> --}}
                            {{-- <th>Links admitted</th> --}}

                            <th>Website Status </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($websites as $site)
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

                            <td>{{ $loop->iteration }} </td>
                            <td>{{ $site->user->email }} </td>
                            <td>{{ $site->web_url }}</td>
                            <td>
                                <button style="padding: 0px; width:21px; height:21px;" type="button"
                                    class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="right"
                                    title="{{ $categoriesList }}">
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                </button>

                            </td>
                            {{-- <td> <button style="padding: 0px; width:21px; height:21px;" type="button"
                                    class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="right"
                                    title="{{ $delicatedTopicsList }}">
                                    <i class="fa fa-ban" aria-hidden="true"></i>
                                </button></td> --}}

                            {{-- <td>{{ $site->post_link }} --}}
                            </td>
                            <td><button style="padding: 0px; width:21px; height:21px;" type="button"
                                    class="btn btn-dark" data-bs-toggle="tooltip" data-bs-placement="right"
                                    title="{{ $site->link_type }}">
                                    <i class="fa fa-exclamation" aria-hidden="true"></i>
                                </button></td>
                            <td id="status-{{ $site->id }}">
                                @if ($site->website_status == 'pending')
                                <span style="font-size: 12px;" class="badge bg-primary">{{ $site->website_status
                                    }}</span>
                                @elseif($site->website_status == 'approve')
                                <span style="font-size: 12px;" class="badge bg-success">{{ $site->website_status
                                    }}</span>
                                @elseif($site->website_status == 'rejected')
                                <span style="font-size: 12px;" class="badge bg-danger">{{ $site->website_status
                                    }}</span>
                                @endif

                            </td>

                            <td>
                                <a href="javascript:void(0);"
                                    onclick="changeWebsiteStatus(`{{ $site->id }}`,`{{ $site->website_status }}`)"
                                    class="btn btn-outline-success btn-icon waves-effect waves-light me-2"
                                    style="padding: 0px; width:21px; height:21px;" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Change Status">
                                    <i class="ri-edit-2-line" aria-hidden="true"></i>
                                </a>

                                <a href="{{ route('admin.website.detail', ['encodedId' => base64_encode($site->id)]) }}"
                                    class="btn btn-outline-primary btn-icon waves-effect waves-light"
                                    style="padding: 0px; width:21px; height:21px;" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="View Details">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                                {{-- if need dropdown then use this below code 👇 --}}

                                {{-- <div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">


                                        <li class="dropdown-item edit-item-btn">
                                            <a onclick="changeWebsiteStatus(`{{ $site->id }}`,`{{ $site->website_status }}`)"
                                                class="dropdown-item text-success" href="javascript:void(0)">Change
                                                Status</a>

                                        </li>
                                        <li class="dropdown-item">
                                            <a
                                                href="{{ route('admin.website.detail',['encodedId'=>base64_encode($site->id )]) }}">
                                                <i class="fa fa-eye me-2"></i> More Detail</a>
                                        </li>
                                    </ul>
                                </div> --}}
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
                $('.Project_Language').select2();
                $('.Select_Country').select2();
                $('.links_per_post').select2();
                $('.links_admitted').select2();
                $('.delicated_topics').select2();
                $('.js-example-basic-multiple').select2();
            });

            function submitForm() {
                document.getElementById('filerWebForm').submit();
            }
        function changeWebsiteStatus(id, status) {
            // alert('Change website status'+status+ 'id'+id);
            (async () => {
                const {
                    value: fruit
                } = await Swal.fire({
                    title: "Select Website Status",
                    input: "select",
                    inputOptions: {
                        pending: "Pending",
                        approve: "Approve",
                        rejected: "Rejected",
                    },
                    inputPlaceholder: "Select to change the Website Status",
                    showCancelButton: true,
                    inputValidator: (value) => {
                        return new Promise((resolve) => {
                            if (value !== status) {
                                $.ajax({
                                    type: 'POST',
                                    url: '{{ route('admin.website.status') }}',
                                    data: {
                                        _token: $('meta[name="csrf-token"]').attr(
                                            'content'),
                                        status: value,
                                        id: id
                                    },
                                    dataType: "json",
                                    success: function(response) {
                                           // Find the status cell and update its content
                                    let statusCell = document.getElementById('status-' + id);
                                    if (statusCell) {
                                        // Remove existing badge classes
                                        statusCell.innerHTML = '';

                                        // Add new badge class based on new status
                                        if (value === 'pending') {
                                            statusCell.innerHTML = '<span style="font-size: 12px;" class="badge bg-primary">' + value + '</span>';
                                        } else if (value === 'approve') {
                                            statusCell.innerHTML = '<span style="font-size: 12px;" class="badge bg-success">' + value + '</span>';
                                        } else if (value === 'rejected') {
                                            statusCell.innerHTML = '<span style="font-size: 12px;" class="badge bg-danger">' + value + '</span>';
                                        }
                                    }
                                        Swal.fire(response.msg);
                                    },
                                    error: function(xhr) {
                                        Swal.fire('Error',
                                            'An error occurred while updating status.',
                                            'error');
                                    }
                                });
                                //ajax call }
                            } else {
                                resolve("Current Website status is " + status+" Choose a different" );
                            }
                        });
                    }
                });
            })()
        }
</script>
@endsection
