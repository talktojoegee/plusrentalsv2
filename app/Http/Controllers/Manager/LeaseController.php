<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\DefaultGLAccount;
use App\Models\Invoice;
use App\Models\LeaseFrequency;
use App\Models\LeaseRenewal;
use App\Models\Property;
use App\Models\PropertyFeature;
use App\Models\PropertyLease;
use App\Models\Receipt;
use App\Models\RentalOwner;
use App\Models\ScheduleLease;
use App\Models\Service;
use App\Models\Tenant;
use App\Models\TenantApplicant;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LeaseController extends Controller
{
    public function __construct(){
        $this->middleware('auth:manager');
        $this->leaseapp = new PropertyLease;
        $this->receipt = new Receipt();
        $this->leasefrequency = new LeaseFrequency();
        $this->tenant = new Tenant();
        $this->tenantapp = new TenantApplicant();
        $this->rentalowner = new RentalOwner();
        $this->property = new Property();
        $this->leaserenewal = new LeaseRenewal();
        $this->leaseschedule = new ScheduleLease();
        $this->service = new Service();
        $this->invoice = new Invoice();

    }

    public function showNewLeaseForm(){
        $properties = $this->property->getAllCompanyVacantProperties();
        $applicants = $this->tenantapp->getAllCompanyPendingApplicants();
        $frequencies = $this->leasefrequency->getAllActiveFrequencies();
        return view('manager.lease.add-new-lease',['properties'=>$properties,'applicants'=>$applicants, 'frequencies'=>$frequencies]);
    }

    public function showLeases(){
        $leases = PropertyLease::where('status','!=',0)->orderBy('id', 'DESC')->get();
        return view('manager.lease.leases', ['leases'=>$leases]);
    }

    public function getProperty(Request $request){
        $property = Property::find($request->property);
        if(!empty($property)){
            return view('manager.lease.partials._property',['property'=>$property]);
        }else{
            return "<p class='text-center text-danger p-2' style='font-weight:700;'>No record found.</p>";
        }
    }
    public function getApplicant(Request $request){
        $applicant = TenantApplicant::find($request->applicant);
        if(!empty($applicant)){
            return view('manager.lease.partials._applicant',['applicant'=>$applicant]);
        }else{
            return "<p class='text-center text-danger p-2' style='font-weight:700;'>No record found.</p>";
        }
    }


    public function storeNewLease(Request $request){
        $this->validate($request,[
           'property'=>'required',
           'applicant'=>'required',
            'start_date'=>'required|date',
            'frequency'=>'required',
            'rent_amount'=>'required'
        ]);
        $frequency = $this->leasefrequency->getLeaseFrequencyById($request->frequency);
        if(!empty($frequency)){
            $this->leaseapp->setNewLeaseApplication($request, $frequency->duration);
            session()->flash("success", "<strong>Great!</strong> New lease application submitted.");
            return back();
        }else{
            session()->flash("error", "<strong>Whoops!</strong> Invalid lease frequency selected. Try again.");
            return back();
        }
    }


    public function leaseApplications(){
        $applicants = $this->tenantapp->getAllCompanyApplicants();
        return view('manager.lease.lease-applications',[
            'applicants'=>$applicants,
            'appThisYear'=>$this->tenantapp->getAllCompanyLeaseApplicationThisYear(),
            'appLastMonth'=>$this->tenantapp->getAllCompanyLeaseApplicationLastMonth(),
            'appThisMonth'=>$this->tenantapp->getAllCompanyLeaseApplicationThisMonth(),
            ]);
    }




    public function viewLeaseApplication($slug){
        $lease = PropertyLease::where('slug', $slug)->first();
        if(!empty($lease)){

            return view('manager.lease.view-lease',['lease'=>$lease]);
        }else{
            return back();
        }
    }

    public function viewLease($slug){
        $lease = PropertyLease::where('slug', $slug)->first();
        if(!empty($lease)){
            $tenant = $this->tenant->getTenantByPropertyId($lease->property_id);
            $property = $this->property->getPropertyById($lease->property_id);
            $features = PropertyFeature::where('property_id', $lease->property_id)->first();
            $leases =  $this->leaserenewal->getAllMyLeases($tenant->id ?? 0);
            return view('manager.lease.view-lease',['lease'=>$lease,
                'features'=>$features, 'tenant'=>$tenant, 'property'=>$property, 'leases'=>$leases]);
        }else{
            return back();
        }
    }

    public function showAddNewLeaseApplicationForm(){
        return view('manager.lease.add-new-lease-application',[
            'properties'=>$this->property->getAllCompanyVacantProperties(),
        ]);
    }


    public function saveNewLeaseApplication(Request $request){
        $this->validate($request,[
            'first_name'=>'required',
            'surname'=>'required',
            'email'=>'required|unique:tenant_applicants,email',
            'mobile_no'=>'required',
            'address'=>'required',
            'date_of_residency'=>'required',
            'property'=>'required'
        ]);
        $property = $this->property->getPropertyById($request->property);
        if(!empty($property)){
            $this->tenantapp->setNewTenantApplication($request, $property->company_id);
            session()->flash("success", "<strong>Great!</strong> Your lease application was submitted successfully.");
            return back();
        }else{
            abort(404, 'Record not found');
        }

    }

    public function generateNewInvoiceFor($applicant, $property){
        $applicant = $this->tenantapp->getTenantApplicant($applicant);
        $property = $this->property->getProperty($property);
        if(!empty($applicant) && !empty($property)){
                return view('manager.lease.generate-invoice-for', [
                    'property'=>$property,
                    'applicant'=>$applicant,
                    'services'=>$this->service->getAllServices()
                ]);
        }else{
            session()->flash("error", "<strong>Whoops!</strong> Record not found.");
            return back();
        }
    }

    public function saveApplicantNewInvoice(Request $request){

        if(empty($request->invoice_type)){
            session()->flash("error", "<strong>Whoops!</strong> Kindly select invoice type");
            return back();
        }else {
            #Process invoice for new applicant
            if ($request->invoice_type == 1) {
                if (empty($request->applicant)) {
                    session()->flash("error", "<strong>Whoops!</strong> Kindly select an applicant");
                    return back();
                } else {
                    $this->validate($request, [
                        'invoice_type' => 'required',
                        'applicant' => 'required',
                        'issue_date' => 'required|date',
                        'due_date' => 'required|date',
                        'service.*' => 'required'
                    ]);
                    $applicant = $this->tenantapp->getApplicantById($request->applicant);
                    if (!empty($applicant)) {
                        $invoice_no = $this->invoice->getLatestInvoiceNo();
                        $this->invoice->generateNewInvoiceForApplicant($request, $applicant, $invoice_no);
                        session()->flash("success", "<strong>Success!</strong> New invoice generated.");
                        return back();
                    } else {
                        session()->flash("error", "<strong>Whoops!</strong> There's no record for the selected applicant.");
                        return back();
                    }
                }

            }
        }
    }

    public function processLeaseApplication(Request $request){

        $this->validate($request,[
            'action'=>'required',
            'property'=>'required',
            'applicant'=>'required'
        ]);
        $app = PropertyLease::where('rental_id', $request->applicant)->where('property_id', $request->property)->first();
        $property_default_account = DefaultGLAccount::where('transaction', 'tenant_account')->first();
        if(empty($property_default_account)){
            session()->flash("error", "<strong>Ooops!</strong> There's no default tenant account. Visit <i>Accounting > Settings</i>");
            return back();
        }
        if(!empty($app)){
                $applicant = TenantApplicant::find($request->applicant);
                $applicant->status = 1; //application approved
                $applicant->save();

                $property = Property::find($request->property);
                $password = substr(sha1(time()),32,40);
                $key = substr(sha1(time()),22,40);
                $current = Carbon::now();
            #Register applicant as tenant
                $tenant = new Tenant;
                $tenant->tenant_app_id = $request->applicant;
                $tenant->email = $applicant->email ?? 'no@email.com';
                $tenant->password = bcrypt($password);
                $tenant->avatar = $applicant->avatar ?? 'avatar.png';

                $tenant->start_date = $current;
                $tenant->end_date = $current->addDays(30);

                $tenant->status = 1; //renting
                $tenant->account_status = 1; //active;
                $tenant->active_subscription_key = "key_".$key;
                $tenant->slug = substr(md5(time()),19,30);
                $tenant->property_id = $request->property; //property assigned to tenant;
                $tenant->tenant_glcode = $property_default_account->glcode;
                $tenant->save();
                $tenantId = $tenant->id;
            #Allocate property to the approved tenant
                $property->allocated_to = $tenantId;
                $property->save();
            #Update lease application
                //$app->processed_by = Auth::user()->id;
                $app->status = 1; //update to renting
                $app->save();
            #Generate receipt
                $counter = 0;
                $receiptNo = Receipt::orderBy('id', 'DESC')->first();
                if(!empty($receiptNo) ){
                    $counter = $receiptNo->receipt_no + 1;
                }else{
                    $counter = 100000;
                }
                //setReceipt($counter, $property, $tenant, $payment_method, $payment_date, $trans_ref, $total);
                $receipt = new Receipt;
                $receipt->receipt_no = $counter;
                $receipt->property_id = $request->property;
                $receipt->tenant_id = $request->applicant;
                $receipt->payment_method = 1;
                $receipt->payment_date = now();
                $receipt->trans_ref = substr(sha1(time()),34,40);
                $receipt->total = $property->rental_price;
                $receipt->save();
                session()->flash("success", "<strong>Success!</strong> Lease application approved.");
                return back();

        }else{
            session()->flash("error", "<strong>Ooops!</strong> Record not found.");
            return back();
        }
    }


    public function showScheduleLeaseForm(){
        return view('manager.lease.schedule-lease', [
            'schedules'=>$this->leaseschedule->getAllScheduleLeases(),
            //'frequencies'=>$this->leasefrequency->getAllActiveFrequencies()
        ]
        );
    }

    public function updateLeaseSchedule(Request $request){
        $this->validate($request,[
            'start_date'=>'required|date',
            'end_date'=>'required',
            'schedule'=>'required'
        ],[
            'start_date.required'=>'Select start date',
            'start_date.date'=>'Start date must be a date'
        ]);
        $frequency = $this->leasefrequency->getLeaseFrequencyById($request->end_date);
        if(!empty($frequency)){
            $this->leaseschedule->updateLeaseSchedule($request, $frequency);
            session()->flash("success", "<strong>Success!</strong> Changes saved.");
            return back();
        }else{
            session()->flash("error", "<strong>Whoops!</strong> No record found.");
            return back();
        }


    }
}
