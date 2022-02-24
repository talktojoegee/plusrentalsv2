<div class="row">
    <div class="col-lg-12">
        <div class="general-info">
            <div class="row">
                <div class="col-lg-12 col-xl-12 col-md-12">
                    <h6 class="text-white text-uppercase ml-3 bg-secondary p-2">Applicant</h6>
                    <div class="table-responsive">
                        <table class="table m-0">
                            <tbody>
                            <tr>
                                <th scope="row">Full Name</th>
                                <td>{{$applicant->first_name ?? ''}} {{$applicant->surname ?? ''}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Mobile No.</th>
                                <td> {{$applicant->mobile_no ?? ''}} </td>
                            </tr>
                            <tr>
                                <th scope="row">Email</th>
                                <td> {{$applicant->email ?? ''}} </td>
                            </tr>
                            <tr>
                                <th scope="row">Gender</th>
                                <td> {{$applicant->gender == 1 ? 'Male' : 'Female' }} </td>
                            </tr>
                            <tr>
                                <th scope="row">Address</th>
                                <td> {{$applicant->address ?? ''}} </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
