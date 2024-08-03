@extends('layouts.app')
@section('title')
Projects List
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
Projects
@endslot
@slot('title')
Projects List
@endslot
@endcomponent

<div class="row">
    <div class="col-md-8 py-2">
        
        @if(session('success'))
        <div class="alert alert-success alert-dismissible bg-success text-white alert-label-icon fade show"
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
        <div class="card">
            <div class="card-header">
               <div class="d-flex justify-content-between">
                <h3>Project List</h3>
                <a href="{{ route('advertiser.projectStep1') }}" class="btn btn-primary waves-effect waves-light">
                    <i class="fa fa-plus"></i> Add project</a>
               </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th>SR No.</th>
                                <th> Name</th>
                                <th>Categories</th>
                                <th>Languages</th>
                                <th>Countries</th>
                                <th>Objectives</th>
                                <th>Competitors</th>
                                <th>Keywords</th>
                                <th>Track Keywords</th>
                                <th>Track Device</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                            @php
                            // Decode JSON columns
                            $categories = json_decode($project->categories, true);
                            $languages = json_decode($project->languages, true);
                            $countries = json_decode($project->countries, true);
                            $objectives = json_decode($project->objectives, true);
                            $competitors = json_decode($project->competitors, true);
                            $trackkeywords = json_decode($project->trackkeywords, true);

                            // Convert arrays to comma-separated lists
                            $categoriesList = is_array($categories) ? implode(', ', $categories) : $categories;
                            $languagesList = is_array($languages) ? implode(', ', $languages) : $languages;
                            $countriesList = is_array($countries) ? implode(', ', $countries) : $countries;
                            $objectivesList = is_array($objectives) ? implode(', ', $objectives) : $objectives;
                            $competitorsList = is_array($competitors) ? implode(', ', $competitors) : $competitors;
                            $trackkeywordsList = is_array($trackkeywords) ? implode(', ', $trackkeywords) : $trackkeywords;
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $project->name }}</td>
                               <td> <button style="padding: 0px; width:21px; height:21px;"
                                type="button" class="btn btn-dark" data-bs-toggle="tooltip"
                                data-bs-placement="right" title="{{ $categoriesList }}">
                                <i class='bx bx-category'></i>
                            </button></td>
                                {{-- <td>{{ $categoriesList }}</td> --}}
                                {{-- <td>{{ $languagesList }}</td> --}}
                                <td> <button style="padding: 0px; width:21px; height:21px;"
                                    type="button" class="btn btn-info" data-bs-toggle="tooltip"
                                    data-bs-placement="right" title="{{ $languagesList }}">
                                    <i class='bx bx-blanket' ></i>
                                </button></td>
                                {{-- <td>{{ $countriesList }}</td> --}}
                                <td> <button style="padding: 0px; width:21px; height:21px;"
                                    type="button" class="btn btn-success" data-bs-toggle="tooltip"
                                    data-bs-placement="right" title="{{ $countriesList }}">
                                    <i class='bx bx-world' ></i>
                                </button></td>
                                {{-- <td>{{ $objectivesList }}</td> --}}
                                <td> <button style="padding: 0px; width:21px; height:21px;"
                                    type="button" class="btn btn-secondary" data-bs-toggle="tooltip"
                                    data-bs-placement="right" title="{{ $objectivesList }}">
                                    <i class='bx bx-objects-horizontal-left'></i>
                                </button></td>
                                {{-- <td>{{ $competitorsList }}</td> --}}
                                <td> <button style="padding: 0px; width:21px; height:21px;"
                                    type="button" class="btn btn-warning" data-bs-toggle="tooltip"
                                    data-bs-placement="right" title="{{ $competitorsList }}">
                                    <i class='bx bxs-component'></i>
                                </button></td>
                                {{-- <td>{{ $project->keywords }}</td> --}}
                                <td> <button style="padding: 0px; width:21px; height:21px;"
                                    type="button" class="btn btn-warning" data-bs-toggle="tooltip"
                                    data-bs-placement="right" title="{{ $project->keywords }}">
                                    <i class='bx bx-dialpad-alt' ></i>
                                </button></td>
                                {{-- <td>{{ $trackkeywordsList }}</td> --}}
                                <td> <button style="padding: 0px; width:21px; height:21px;"
                                    type="button" class="btn btn-danger" data-bs-toggle="tooltip"
                                    data-bs-placement="right" title="{{ $trackkeywordsList }}">
                                    <i class='bx bx-git-repo-forked'></i>

                                </button></td>
                                <td>{{ $project->track_device }}</td>
                                <td>
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="ri-more-fill align-middle"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <form action="{{ route('advertiser.project.delete',$project->id) }}" method="POST">
                                                    @csrf

                                                    <button type="submit" class="dropdown-item edit-item-btn"
                                                        onclick="return confirm('Are you sure you want to delete this project?');">
                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                        Delete
                                                    </button>
                                                </form>
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
@endsection
