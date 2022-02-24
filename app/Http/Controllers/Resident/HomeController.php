<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Property;
use App\Models\PropertyInspectionSchedule;
use App\Models\PropertyLease;
use App\Models\SubCategory;
use App\Models\Location;
use App\Models\Area;
use App\Models\Ad;
use App\Models\AdsGallery;
use App\Models\TenantApplicant;
use App\Models\Wishlist;
use App\Models\AdsReview;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //public $property;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->property = new Property;
        $this->propertylease = new PropertyLease;
        $this->tenantapp = new TenantApplicant;
        $this->propertyinspection = new PropertyInspectionSchedule();
        $this->location = new Location();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $properties = $this->property->getVacantProperties();
        $for_rent = $this->property->getVacantPropertiesByListingType(1);
        $for_sale = $this->property->getVacantPropertiesByListingType(2);
        /*$now = Carbon::now();
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $adverts = Ad::orderBy('id', 'DESC')->paginate(20);
        foreach($adverts as $advert){
            if($advert->end_date > $now->today()){
                $advert->status = 4;
                $advert->save();
            }
        }*/
        return view('frontend.index',
            ['properties'=>$properties,
                'for_rent'=>$for_rent,
                'for_sale'=>$for_sale,
                'locations'=>$this->location->getLocations()
                ]);
    }

    public function viewListing($slug){
        $property = $this->property->getProperty($slug);
        if(!empty($property)){

            return view('frontend.property-details',['property'=>$property]);
        }else{
            return back();
        }
    }

    public function propertyListing(){
        $properties = $this->property->getVacantPaginatedProperties();
        $locations = $this->location->getLocations();
        return view('frontend.property-listing',
            ['properties'=>$properties,
                'locations'=>$locations,
                'search'=>0,//not search request
                'keyword'=>''
            ]);
    }

    public function searchForProperty(Request $request){
        $this->validate($request,[
           'search_phrase'=>'required',
           'location'=>'required',
            'area'=>'required'
        ],[
            'search_phrase.required'=>'Enter keyword or search phrase',
            'location.required'=>'Choose a location',
            'area.required'=>"What's your area of interest?"
        ]);
        $properties = $this->property->searchPropertyByKeyword($request->search_phrase);
        $locations = $this->location->getLocations();
        return view('frontend.property-listing',
            ['properties'=>$properties,
                'locations'=>$locations,
                'search'=>1,//search request
                'keyword'=>$request->search_phrase
            ]);
    }


   /* public function submitLeaseApp(Request $request){
        $this->validate($request,[
            'property'=>'required',
            'applicant'=>'required',
            'start_date'=>'required|date',
            'end_date'=>'required|date',
            'rent_amount'=>'required'
        ]);
        $this->propertylease->setNewLeaseApplication($request);
        session()->flash("success", "<strong>Great!</strong> New lease application submitted.");
        return back();
    }*/


    public function registerNewTenantApplication(Request $request){

        $this->validate($request,[
            'first_name'=>'required',
            'surname'=>'required',
            //'gender'=>'required',
            'email'=>'required|email|unique:tenant_applicants,email',
            'mobile_no'=>'required',
            'address'=>'required',
            'date_of_residency'=>'required',
            'property'=>'required'
        ],[
            'first_name.required'=>'Enter your first name',
            'surname.required'=>'Enter your surname',
            'email.required'=>'Enter a valid email address',
            'email.email'=>'Enter a valid email address',
            'mobile_no.required'=>'Enter your mobile number',
            'address.required'=>'Enter either your office or residential address',
            'date_of_residency.required'=>'When are you looking forward to taking the property?'
        ]);
        $property = $this->property->getPropertyById($request->property);
        if(!empty($property)){
            $this->tenantapp->setNewTenantApplication($request, $property->company_id);
            session()->flash("success", "<strong>Great!</strong> Thank you for your interest in this property. We'll get back to you as soon as possible.");
            return back();
        }else{
            session()->flash("error", "<strong>Whoops!</strong> Something went wrong. Try again.");
            return back();
        }
    }


    public function schedulePropertyInspection(Request $request){
        $this->validate($request, [
            'properti'=>'required',
            'full_name'=>'required',
            'email_address'=>'required',
            'mobile_no'=>'required',
            'message'=>'required',
            'schedule_date_time'=>'required|date',
        ],[
            'full_name.required'=>'Kindly enter your full name',
            'email_address.required'=>"We'll need your email address for communication",
            'mobile_no.required'=>'This information will be very helpful to get in touch with you',
            'message.required'=>"Leave a message",
            'schedule_date_time.required'=>'When will be more convenient to carry out this inspection?',
            'schedule_date_time.date'=>'Enter a valid date format'
        ]);
        $property = $this->property->getPropertyById($request->properti);
        if(!empty($property)){
            $this->propertyinspection->setPropertyInspectionShedule($request, $property->company_id);
            session()->flash("success", "<strong>Good news!</strong> We'll be glad to take you around for inspection. Our team will get in touch with you soon." );
            return back();
        }else{
            session()->flash("error", "<strong>Whoops!</strong> Something went wrong.");
            return back();
        }

    }


    public function pricing(){
        return view('frontend.pricing');
    }








    public function viewAdvert($slug){
         $advert = Ad::where('slug', $slug)/* ->where('status',1)->orWhere('status',0) */->first();
       $categories = Category::orderBy('category_name', 'ASC')->get();
        if(!empty($advert)){
            $related = Ad::where('category_id', $advert->category_id)
                /* ->where('status',1) */
                ->where('id', '!=', $advert->id)->get();
            $total_reviews = AdsReview::where('advertised_by', $advert->customer_id)->get();
                return view('ads.advert-detail', ['my_ad'=>$advert,
                'total_reviews'=>$total_reviews,
                'related'=>$related,
                'categories'=>$categories
                ]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> This advert must have expired or does not exist.");
            return back();
        }

    }

   /*  public function advertDetail($slug){
       $advert = Ad::where('slug', $slug)->first();
       $categories = Category::orderBy('category_name', 'ASC')->get();
        if(!empty($advert)){
            $related = Ad::where('category_id', $advert->category_id)
                ->where('status',1)
                ->where('id', '!=', $advert->id)->get();
            $total_reviews = AdsReview::where('advertised_by', $advert->customer_id)->count();
            if($advert->customer_id == Auth::user()->id){
                return view('ads.my-advert-detail', ['detail'=>$advert,
                'related'=>$related,
                'categories'=>$categories,
                'total_reviews'=>$total_reviews
                ]);
            }else{
                return view('ads.advert-detail', ['detail'=>$advert, 'total_reviews'=>$total_reviews, 'related'=>$related, 'categories'=>$categories]);
            }
        }else{
            session()->flash("error", "<strong>Ooops!</strong> This advert must have expired or does not exist.");
            return back();
        }

   } */

    public function contactVendor($vendor){
        $vendor = Customer::where('slug', $vendor)->first();
        if(!empty($vendor)){
            return view('vendors.contact-vendors', ['vendors'=>$vendor]);
        }else{
            return back();
        }
    }

    public function getAdvertByCategory($slug){
        $cat = Category::where('slug', $slug)->first();
        if(!empty($cat)){
            $adverts = Ad::where('category_id', $cat->id)->paginate(10);
            return view('related-ads',['adverts'=>$adverts, 'cat'=>$cat]);
        }else{
            return back();
        }
    }

    public function faqs(){
        return view('misc.faqs');
    }
    public function tips(){
        return view('misc.tips');
    }
    public function terms(){
        return view('misc.terms');
    }
    public function policies(){
        return view('misc.policies');
    }
}
