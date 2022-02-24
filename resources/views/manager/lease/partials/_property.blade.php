<div class="row">
    <div class="col-lg-12">
        <div class="general-info">
            <div class="row">
                <div class="col-lg-12 col-xl-12 col-md-12">
                    <h6 class="text-white text-uppercase ml-3 bg-secondary p-2">Property</h6>
                    <div class="table-responsive">
                        <table class="table m-0">
                            <tbody>
                            <tr>
                                <th scope="row">Property Name.</th>
                                <td>{{$property->property_name ?? ''}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Property Type</th>
                                <td>
                                    @switch($property->property_type)
                                        @case(1)
                                        Apartment
                                        @break
                                        @case(2)
                                        House
                                        @break
                                        @case(3)
                                        Land
                                        @break
                                        @case(4)
                                        Townhouse
                                        @break
                                        @case(5)
                                        Garden Cottage
                                        @break
                                        @case(6)
                                        Farm
                                        @break
                                    @endswitch
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Unit No.</th>
                                <td>{{$property->unit_no ?? ''}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Location</th>
                                <td>{{$property->getLocation->location_name ?? ''}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Area</th>
                                <td>{{$property->getArea->area_name ?? ''}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Address</th>
                                <td>{{$property->address ?? ''}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Rental Amount</th>
                                <td>{{ '₦'.number_format($property->rental_price ?? 0,2)}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Security Fee</th>
                                <td>{{ '₦'.number_format($property->security_deposit ?? 0,2)}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Late Fee</th>
                                <td class="text-danger">{{ '₦'.number_format($property->late_fee ?? 0,2)}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Recurring Charge</th>
                                <td class="text-info">
                                    @switch($property->frequency)
                                        @case('1')
                                        Monthly
                                        @break
                                        @case('2')
                                        Quarterly
                                        @break
                                        @case('3')
                                        Bi-annually
                                        @break
                                        @case('4')
                                        Annual
                                        @break
                                    @endswitch
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
