@extends('layouts.master-layout')
@section('title')
    Add New Listing
@endsection

@section('current-page')
    Add New Listing
@endsection
@section('current-page-brief')

@endsection

@section('event-area')
    @include('manager.lease.partials._menu')
@endsection
@section('extra-styles')
 <link rel="stylesheet" type="text/css" href="\bower_components\jquery.steps\css\jquery.steps.css">
@endsection
@section('main-content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Design Wizard</h5>
                    <span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="wizard3">
                                <section>
                                    <form class="wizard-form wizard clearfix" id="design-wizard" action="#" role="application"><div class="steps clearfix"><ul role="tablist"><li role="tab" class="first current" aria-disabled="false" aria-selected="true"><a id="design-wizard-t-0" href="#design-wizard-h-0" aria-controls="design-wizard-p-0"><span class="current-info audible">current step: </span><span class="number">1.</span> </a></li><li role="tab" class="disabled" aria-disabled="true"><a id="design-wizard-t-1" href="#design-wizard-h-1" aria-controls="design-wizard-p-1"><span class="number">2.</span> </a></li><li role="tab" class="disabled" aria-disabled="true"><a id="design-wizard-t-2" href="#design-wizard-h-2" aria-controls="design-wizard-p-2"><span class="number">3.</span> </a></li><li role="tab" class="disabled last" aria-disabled="true"><a id="design-wizard-t-3" href="#design-wizard-h-3" aria-controls="design-wizard-p-3"><span class="number">4.</span> </a></li></ul></div><div class="content clearfix">
                                        <h3 id="design-wizard-h-0" tabindex="-1" class="title current"></h3>
                                        <fieldset id="design-wizard-p-0" role="tabpanel" aria-labelledby="design-wizard-h-0" class="body current" aria-hidden="false">
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label for="userName-2" class="block">User name *</label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <input id="userName-23" name="userName" type="text" class=" form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label for="email-2" class="block">Email *</label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <input id="email-23" name="email" type="email" class=" form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label for="password-2" class="block">Password *</label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <input id="password-23" name="password" type="password" class="form-control ">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label for="confirm-2" class="block">Confirm Password *</label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <input id="confirm-23" name="confirm" type="password" class="form-control ">
                                                </div>
                                            </div>
                                        </fieldset>
                                        <h3 id="design-wizard-h-1" tabindex="-1" class="title"></h3>
                                        <fieldset id="design-wizard-p-1" role="tabpanel" aria-labelledby="design-wizard-h-1" class="body" aria-hidden="true" style="display: none;">
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label for="name-2" class="block">First name *</label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <input id="name-23" name="name" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label for="surname-2" class="block">Last name *</label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <input id="surname-23" name="surname" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label for="phone-2" class="block">Phone #</label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <input id="phone-23" name="phone" type="number" class="form-control phone">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label for="date" class="block">Date Of Birth</label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <input id="date3" name="Date Of Birth" type="text" class="form-control date-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">Select Country</div>
                                                <div class="col-sm-12">
                                                    <select class="form-control required">
                                                        <option>Select State</option>
                                                        <option>Gujarat</option>
                                                        <option>Kerala</option>
                                                        <option>Manipur</option>
                                                        <option>Tripura</option>
                                                        <option>Sikkim</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <h3 id="design-wizard-h-2" tabindex="-1" class="title"></h3>
                                        <fieldset id="design-wizard-p-2" role="tabpanel" aria-labelledby="design-wizard-h-2" class="body" aria-hidden="true" style="display: none;">
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label for="University-2" class="block">University</label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <input id="University-23" name="University" type="text" class="form-control required">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label for="Country-2" class="block">Country</label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <input id="Country-23" name="Country" type="text" class="form-control required">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label for="Degreelevel-2" class="block">Degree level #</label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <input id="Degreelevel-23" name="Degree level" type="text" class="form-control required phone">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label for="datejoin" class="block">Date Join</label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <input id="datejoin3" name="Date Of Birth" type="text" class="form-control required">
                                                </div>
                                            </div>
                                        </fieldset>
                                        <h3 id="design-wizard-h-3" tabindex="-1" class="title"></h3>
                                        <fieldset id="design-wizard-p-3" role="tabpanel" aria-labelledby="design-wizard-h-3" class="body" aria-hidden="true" style="display: none;">
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label for="Company-2" class="block">Company:</label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <input id="Company-23" name="Company:" type="text" class="form-control required">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label for="CountryW-2" class="block">Country</label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <input id="CountryW-23" name="Country" type="text" class="form-control required">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label for="Position-2" class="block">Position</label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <input id="Position-23" name="Position" type="text" class="form-control required">
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="actions clearfix">
                                        <ul role="menu" aria-label="Pagination">
                                            <li class="disabled" aria-disabled="true"><a href="#previous" role="menuitem">Previous</a></li>
                                            <li aria-hidden="false" aria-disabled="false"><a href="#next" role="menuitem">Next</a></li>
                                            <li aria-hidden="true" style="display: none;"><a href="#finish" role="menuitem">Finish</a></li>
                                        </ul>
                                    </div>
                                </form>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('extra-scripts')

   <script src="\bower_components\jquery.cookie\js\jquery.cookie.js"></script>
    <script src="\bower_components\jquery.steps\js\jquery.steps.js"></script>
    <script src="\bower_components\jquery-validation\js\jquery.validate.js"></script>
@endsection
