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
        @if (session('error'))
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
    <div class="card px-4">
        <form action="" id="filerWebForm">
            <div class="row py-3">
                <div class="col-12 text-end">
                    <a href="{{ route('publishers.website') }}" class="btn btn-dark"> <i class="fa fa-search me-1"
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
                        <select name="audience" class="select2 form-control" onchange="submitForm()">
                            <option value="" disabled selected>Select an option</option>
                            @foreach (config('countries.countries') as $country)
                            <option value="{{ $country }}" {{ old('audience') == $country ? 'selected' : '' }}>
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
                        <select name="categories" class="select2 form-control" onchange="submitForm()">
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
                        <select name="link_type" class="select2 form-control" id="links_admitted" onchange="submitForm()">
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
                        <select required class="select2 form-control" name="language" id="Website_Language"
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
                        <select name="sponsorship" class="select2 form-control" onchange="submitForm()">
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
                            {{-- <th>Links per post </th> --}}
                            <th>Links admitted</th>
                            <th>Website Status </th>
                            <th>Created_at </th>
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
                        <tr id="websiteRow-{{ $site->id }}" data-id="{{ $site->id }}">

                            <td>{{ $loop->iteration }} </td>
                            <td>
                                <a target="_blank" href="{{ $site->web_url }}">{{ $site->web_url }}</a>
                            </td>
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

                            {{-- <td>{{ $site->post_link }} --}}
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
                            <td>{{ $site->created_at->format('d F Y') }}</td>

                            <td class="d-flex">
                                <!-- View Button -->
                                <a href="{{ route('publishers.website.detail', ['encodedId' => base64_encode($site->id)]) }}"
                                    class="btn btn-outline-primary btn-icon waves-effect waves-light me-2"
                                    style="padding: 0px; width:21px; height:21px;" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="View Website">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>

                                <!-- Delete Button -->
                                <form method="POST" data-id="{{ $site->id }}">
                                    @csrf
                                    <button type="button"
                                        class="btn btn-outline-danger btn-icon waves-effect waves-light deletewebBtn"
                                        style="padding: 0px; width:21px; height:21px;" data-bs-toggle="modal"
                                        data-bs-target="#delete" data-id="{{ $site->id }}" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Delete Website">
                                        <i class="ri-delete-bin-5-line"></i>
                                    </button>
                                </form>
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
{{-- delete modal 🛑 --}}
<div class="modal fade" id="delete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="deleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center p-5">
                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                    colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                <div class="mt-4">
                    <h4>Are you Sure ?</h4>
                    <p class="text-muted mx-4 mb-0">Are you Sure You want to Delete this website ?</p>
                    <div class="hstack gap-2 justify-content-center mt-3">
                        <a href="javascript:void(0);" class="btn btn-soft-success" data-bs-dismiss="modal"><i
                                class="ri-close-line me-1 align-middle"></i> Cancel</a>
                        <a href="javascript:void(0);" class="btn btn-danger" id="confirmDeleteBtn">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
        @if(session('success'))
        Swal.fire({
            title: 'Thank You 👍',
            text: '{{ session('
            success ') }}',
            icon: 'success'
        });
        @endif
    });

    function submitForm() {
        document.getElementById('filerWebForm').submit();
    }
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
<script>
    $(document).ready(function() {
        var webId;
        // Set webId when delete button is clicked
        $('.deletewebBtn').on('click', function() {
            webId = $(this).data('id');
        });
        // Handle the confirm delete action
        $('#confirmDeleteBtn').on('click', function() {
            var token = $("input[name='_token']").val();
            $.ajax({
                url: "{{ route('publishers.websiteDelete', '') }}/" + webId,
                type: 'POST',
                data: {
                    _token: token,
                    _method: 'DELETE'
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: "Thank You 👍",
                            text: response.message,
                            icon: "success"
                        });
                        $('#websiteRow-' + webId)
                            .remove(); // Correctly removing the row with the website ID
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: response.message,
                        });
                    }
                    $('#delete').modal('hide'); // Hide the modal
                },
                error: function() {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: 'Something went wrong while deleting the website.',
                    });
                    $('#delete').modal('hide'); // Hide the modal
                }
            });
        });
    });
</script>

</script>
@endsection
