@extends('layouts.app')
@section('title')
Users | Admin
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
Users
@endslot
@endcomponent
<div class="row">
    <div class="col-8 py-3">

        <!-- Secondary Alert -->
        @if (session('success'))
        <div class="alert alert-secondary alert-dismissible bg-secondary text-white alert-label-icon fade show"
            role="alert">
            <i class="ri-check-double-line label-icon"></i>
            <strong>Success</strong> - {{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @elseif(session('error'))
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
    <div class="col-12">
       <div class="card p-3">
        <form action="" id="filterForm">
            <div class="row">

                <div class="col-7">
                    <a href="{{ route('admin.user.list') }}" class="btn btn-primary"> <i class="fa fa-search me-1"
                        aria-hidden="true"></i>All Results</a>

                </div>
                <div class="col-5">
                    <label> Filter by user role</label>
                    <br>
                    <select name="role" class="js-example-basic-single links_admitted form-control" onchange="submitForm()">
                        <option value="" disabled selected>Select an option</option>
                        <option value="publisher">Publisher
                        </option>
                        <option value="advertiser">Advertiser
                        </option>


                    </select>

                </div>
            </div>


        </form>
       </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header ">
                <h3 class="">Users List</h3>


            </div>
            <div class="card-body">
                <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                    <thead>
                        <tr>

                            <th>SR No.</th>
                            <th>Name</th>
                            <th>Email </th>
                            <th>Account Type </th>
                            <th>created_at</th>
                            {{-- <th>Status</th> --}}
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr id="userRow-{{ $user->id }}" data-id="{{ $user->id }}">
                            <td>{{ $loop->iteration }}</td> <!-- Corrected -->
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->role == 'advertiser')
                                <span style="font-size: 12px;" class="badge bg-primary">{{ $user->role }}</span>
                                @elseif($user->role == 'publisher')
                                <span style="font-size: 12px;" class="badge bg-success">{{ $user->role }}</span>
                                @endif
                            </td>
                            <td>{{ $user->created_at->format('F j, Y') }}</td>
                            <td class="d-flex">
                                <a href="{{ route('admin.user.detail', ['encodedId' => base64_encode($user->id)]) }}"
                                    class="btn btn-outline-primary btn-icon waves-effect waves-light me-2"
                                    style="padding: 0px; width:21px; height:21px;"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="View user">
                                     <i class="fa fa-eye" aria-hidden="true"></i>
                                 </a>

                                 <form method="POST" data-id="{{ $user->id }}">
                                     @csrf
                                     <button type="button"
                                             class="btn btn-outline-danger btn-icon waves-effect waves-light deleteUserBtn"
                                             style="padding: 0px; width:21px; height:21px;"
                                             data-bs-toggle="modal" data-bs-target="#delete"
                                             data-id="{{ $user->id }}"
                                             data-bs-toggle="tooltip"
                                             data-bs-placement="top" title="Delete user">
                                         <i class="ri-delete-bin-5-line"></i>
                                     </button>
                                 </form>

                                  {{-- if add dropdown then use this code 🤍 --}}
                                {{-- <div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a href="{{ route('admin.user.detail', ['encodedId' => base64_encode($user->id)]) }}"
                                                class="dropdown-item edit-item-btn">
                                                <i class="fa fa-eye me-2 text-primary" aria-hidden="true"></i>View
                                            </a>
                                        </li>
                                        <li>
                                            <form method="POST" data-id="{{ $user->id }}">
                                                @csrf
                                                <button type="button" class="dropdown-item edit-item-btn deleteUserBtn"
                                                    data-bs-toggle="modal" data-bs-target="#delete"
                                                    data-id="{{ $user->id }}">
                                                    <i class="ri-delete-bin-fill align-bottom me-2 text-danger"></i>
                                                    Delete
                                                </button>
                                            </form>
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
                    <p class="text-muted mx-4 mb-0">Are you Sure You want to Delete this user ?</p>
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
                $('.Project_Language').select2();
                $('.Select_Country').select2();
                $('.links_per_post').select2();
                $('.links_admitted').select2();
                $('.delicated_topics').select2();
                $('.js-example-basic-multiple').select2();
            });
function submitForm(){
    document.getElementById('filterForm').submit();

}

    $(document).ready(function() {
        var userId;

        // Set userId when delete button is clicked
        $('.deleteUserBtn').on('click', function() {
            userId = $(this).data('id');
        });

        // Handle the confirm delete action
        $('#confirmDeleteBtn').on('click', function() {
            var token = $("input[name='_token']").val();

            $.ajax({
                url: "{{ route('admin.user.delete', '') }}/" + userId,
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

                        $('#userRow-' + userId).remove(); // Remove the row from the table
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
                        text: ' Something went wrong while deleting the user.',
                    });
                    $('#delete').modal('hide'); // Hide the modal
                }
            });
        });
    });
</script>
@endsection
