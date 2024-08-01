@extends('layouts.app')
@section('title') Contact-Support | publishers @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1')
Publishers
@endslot
@slot('title')
Contact-Support
@endslot
@endcomponent

<div class="row">
    <div class="col-8 mx-auto">
        <div class="card">
            <div class="card-header">

                <h2 class="card-title mb-0">Contact your personal support</h2>
            </div>
           <div class="card-body p-4">
            <form action="#" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="Subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="Subject"  required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="Message" class="form-label">Message</label>
                            <textarea class="form-control" id="Message" cols="30" rows="10"></textarea>

                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
           </div>


     </div>
</div>

@endsection

