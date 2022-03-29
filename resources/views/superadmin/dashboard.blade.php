@extends('layouts.admin-layout')
@section('title')
    Manage FAQs
@endsection

@section('current-page')
    Manage FAQs
@endsection
@section('current-page-brief')
    Manage all FAQs
@endsection

@section('event-area')
    <div class="btn-group">
        <a class="btn btn-secondary btn-mini" href="#"><i class="icofont icofont-tags"></i>Manage FAQs</a>
        <a class="btn btn-primary btn-mini" href="#"><i class="icofont icofont-tasks"></i>Add New FAQs</a>
    </div>
@endsection
@section('extra-styles')

@endsection
@section('main-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-header-text">Frequently Asked Questions</h5>
                </div>
                <div class="card-block accordion-block">
                    <div id="accordion" role="tablist" aria-multiselectable="true">
                        @php $serial = 1; @endphp

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('extra-scripts')

@endsection
