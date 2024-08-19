@extends('layouts.app')
@section('title')
wallet | {{ auth()->user()->role }}
@endsection
@section('css')
<link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet"
    type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1')
advertiser
@endslot
@slot('title')
wallet
@endslot
@endcomponent

<div class="row">
    <div class="col-xxl-3 col-sm-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="fw-medium text-muted mb-0">Added credit</h3>
                        <h2 class="mt-4 ff-secondary fw-semibold">${{ $totalAmount }}
                        </h2>

                    </div>
                    <div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-info-subtle text-info rounded-circle fs-4">
                                <i class="ri-ticket-2-line"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div><!-- end card body -->
        </div> <!-- end card-->
    </div>
    <!--end col-->
    <div class="col-xxl-3 col-sm-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="fw-medium text-muted mb-0">Reserved</h3>
                        <h2 class="mt-4 ff-secondary fw-semibold">0
                        </h2>

                    </div>
                    <div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-info-subtle text-info rounded-circle fs-4">
                                <i class="mdi mdi-timer-sand"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div><!-- end card body -->
        </div>
    </div>
    <!--end col-->
    <div class="col-xxl-3 col-sm-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="fw-medium text-muted mb-0">Total Spend</h3>
                        <h2 class="mt-4 ff-secondary fw-semibold">0
                        </h2>
                    </div>
                    <div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-info-subtle text-info rounded-circle fs-4">
                                <i class="ri-shopping-bag-line"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div><!-- end card body -->
        </div>
    </div>
    <div class="col-xxl-3 col-sm-6">
       <a href="{{ route('advertiser.bill.detail') }}">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="fw-medium text-muted mb-0">Add Billing Detail</h3>
                        <h2 class="mt-4 ff-secondary fw-semibold">0
                        </h2>
                    </div>
                    <div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-info-subtle text-info rounded-circle fs-4">
                                <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div><!-- end card body -->
        </div>
       </a>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card" id="ticketsList">
            <div class="card-header border-0">
                <div class="d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1">Transaction History</h5>
                    <div class="flex-shrink-0">
                        <div class="d-flex flex-wrap gap-2">
                            <a class="btn btn-primary" href="{{ route('advertiser.bill.detail') }}"><i class="ri-add-line align-bottom me-1"></i>Add credit</a>
                        </div>
                    </div>
                </div>
            </div>

            <!--end card-body-->
            <div class="card-body">
                <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>SR No.</th>
                            <th>Date</th>
                            {{-- <th>user_id</th> --}}
                            <th>Amount </th>
                            <th>payment_method</th>
                            <th>coupon</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($creditDetail as $detail)
                       <tr>
                        <td>{{$loop->iteration  }}</td>
                        <td>{{ $detail->created_at->format('d F Y') }}</td>
                        {{-- <td>{{$detail->user_id  }}</td> --}}
                        <td>${{$detail->amount  }}</td>
                        <td>{{$detail->payment_method  }}</td>
                        <td>
                            @if($detail->coupon  )
                            {{$detail->coupon  }}
                            @else
                            Not add
                            @endif
                        </td>
                       </tr>

                        @endforeach



                    </tbody>
                </table>
            </div>
            <!--end card-body-->
        </div>
        <!--end card-->
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
@endsection


