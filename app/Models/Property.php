<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class Property extends Model
{
    use HasFactory;

    public function getRentalOwner(){
        return $this->belongsTo(RentalOwner::class,'rental_owner_id');
    }

    public function getCompany(){
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function getAddedBy(){
        return $this->belongsTo(User::class,'added_by');
    }

    public function getExteriorGallery(){
        return $this->hasMany(PropertyExteriorGallery::class, 'property_id');
    }

    public function getInteriorGallery(){
        return $this->hasMany(PropertyInteriorGallery::class, 'property_id');
    }

    public function getFeaturedInteriorImage()
    {
        return $this->belongsTo(PropertyInteriorGallery::class, 'id');
    }

    public function getPropertyFeatures(){
        return $this->belongsTo(PropertyFeature::class, 'id');
    }

    public function getPropertyApplications(){
        return $this->hasMany(TenantApplicant::class, 'property_id');
    }

    public function getLeaseFrequency(){
        return $this->belongsTo(LeaseFrequency::class, 'frequency');
    }

    public function getLocation(){
        return $this->belongsTo(Location::class, 'location_id');
    }
    public function getArea(){
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function getPropertyInvoices(){
        return $this->hasMany(Invoice::class, 'property_id');
    }

    public function getPropertyReceipts(){
        return $this->hasMany(Receipt::class, 'property_id');
    }

    public function getPropertyGlAccount(){
        return $this->belongsTo(ChartOfAccount::class, 'property_account', 'glcode');
    }

    public function getCurrentlyRenting(){
        return $this->belongsTo(PropertyLease::class, 'property_id');
    }

    public function getAllocatedTo(){
        return $this->belongsTo(Tenant::class, 'allocated_to');
    }






    #Use-case methods

    public function getAllProperties(){
        return Property::orderBy('id', 'DESC')->get();

    }
    public function getAllCompanyProperties(){
       return Property::where('company_id', Auth::user()->company_id)->orderBy('id', 'DESC')->get();

    }

    public function getAllCompanyPropertyReport(Request $request, $location){
        $start = $request->start_date;
        $end = $request->end_date;
        if($location != 0){
            return Property::where('company_id', Auth::user()->company_id)
                ->whereBetween('created_at', [$start, $end])
                ->where('location_id', $location)
                ->orderBy('id', 'DESC')
                ->get();
        }else{
            return Property::where('company_id', Auth::user()->company_id)
                ->whereBetween('created_at', [$start, $end])
                ->orderBy('id', 'DESC')
                ->get();
        }


    }
    public function getAllCompanyPropertyReportByStatus(Request $request, $location){
        if($location != 0){
            return Property::where('company_id', Auth::user()->company_id)
                ->where('status', $request->status)
                ->where('location_id', $location)
                ->orderBy('id', 'DESC')
                ->get();
        }else{
            return Property::where('company_id', Auth::user()->company_id)
                ->where('status', $request->status)
                ->orderBy('id', 'DESC')
                ->get();
        }
    }

    public function getVacantProperties(){
        return Property::where('status',0)->orderBy('id', 'DESC')->get();

    }

    public function getVacantPaginatedProperties(){
        return Property::where('status',0)->orderBy('id', 'DESC')->paginate(20);

    }
    public function searchPropertyByKeyword($keyword){
        //return Property::where('status',0)->orderBy('id', 'DESC')->paginate(3);
        return Property::where('status',0)->where('property_name', 'like', '%' . $keyword . '%')->orderBy('id', 'DESC')->paginate(20);
    }

    public function getAllCompanyVacantProperties(){
        return Property::where('status',0)->where('company_id', Auth::user()->company_id)->orderBy('id', 'DESC')->get();

    }

    public function getPropertiesForSale(){
        return Property::all();
    }

    public function getVacantPropertiesByListingType($value){
        return Property::where('listing_type',$value)->where('status',0)->take(10)->get();
    }

    public function getSimilarVacantPropertyListingByLocationId($location_id){
        return Property::where('location_id', $location_id)->where('status', 0)->take(10)->get();
    }

    public function setNewProperty(Request $request, $property_default_account){
        #Property
        $property = new Property;
        $property->property_type = $request->property_type;
        $property->property_name = $request->property_name ?? '';
        $property->unit_no = $request->unit_no ?? '';
        $property->location_id = $request->location;
        $property->area_id = $request->area;
        $property->address = $request->address;
        $property->purchase_date = $request->purchase_date;
        $property->purchase_price = $request->purchase_price;
        $property->current_valuation = $request->current_valuation;
        $property->rental_price = $request->rental_price;
        $property->security_deposit = $request->security_deposit ?? 0;
        $property->late_fee = $request->late_fee ?? 0;
        $property->frequency = $request->frequency ?? 0;
        $property->property_account = $request->default_account == 2 ? $request->property_account :  $property_default_account->glcode;
        $property->added_by = Auth::user()->id;
        $property->rental_owner_id = Auth::user()->company_id;
        $property->slug = Str::slug($request->property_name).'-'.substr(sha1(time()),32,40);
        $property->listing_type = $request->listing_type ?? 1;
        $property->description = $request->description ?? '';
        $property->company_id = Auth::user()->company_id;
        $property->save();
        $propertyId = $property->id;
        #Features
        $features = new PropertyFeature;
        $features->bedrooms = $request->bedrooms ?? 0;
        $features->bedrooms_comment = $request->bedrooms_comment ?? '';
        $features->bathrooms = $request->bathrooms ?? 0;
        $features->bathrooms_comment = $request->bathrooms_comment ?? '';
        $features->study_room = $request->study_room ?? 0;
        $features->study_room_comment = $request->study_room_comment ?? '';
        $features->dinning_room = $request->dinning_room ?? 0;
        $features->dinning_room_comment = $request->dinning_room_comment ?? '';
        $features->carports = $request->carports ?? 0;
        $features->carports_comment = $request->carports_comment ?? '';
        $features->kitchens = $request->kitchens ?? 0;
        $features->kitchens_comment = $request->kitchens_comment ?? '';
        $features->garages = $request->garages ?? 0;
        $features->garages_comment = $request->garages_comment ?? '';
        $features->flooring = $request->flooring ?? 0;
        $features->flooring_type = $request->flooring_type ?? 1;
        $features->laundry = $request->laundry ?? 0;
        $features->laundry_comment = $request->laundry_comment ?? '';
        $features->balcony = $request->balcony ?? 0;
        $features->balcony_comment = $request->balcony_comment ?? '';
        $features->pool = $request->pool ?? 0;
        $features->pool_comment = $request->pool_comment ?? '';
        $features->garden = $request->garden ?? 0;
        $features->garden_comment = $request->garden_comment ?? 0;
        $features->views = $request->views ?? 0;
        $features->views_comment = $request->views_comment ?? '';
        $features->security = $request->security ?? 0;
        $features->security_comment = $request->security_comment ?? '';
        $features->store_room = $request->store_room ?? 0;
        $features->store_room_comment = $request->store_room_comment ?? '';
        $features->lounges = $request->lounges ?? 0;
        $features->lounges_comment = $request->lounges_comment ?? '';
        $features->property_id = $propertyId;
        $features->company_id = Auth::user()->company_id;
        $features->save();
        $watermark = public_path('/assets/images/watermark/watermark.png');
        #Interior Image Gallery
        if($request->hasFile('interior_images'))
        {
            foreach($request->file('interior_images') as $file)
            {
                $image = Image::make($file);
                $extension = $file->getClientOriginalExtension();
                $dir = 'assets/images/property/interior/';
                $gallery_name = '_' . uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
                $image->insert($watermark, 'bottom-right', 5, 5);
                $image->save(public_path($dir.$gallery_name));
                $gallery = new PropertyInteriorGallery;
                $gallery->directory = $gallery_name;
                $gallery->property_id = $propertyId;
                $gallery->company_id = Auth::user()->company_id;
                $gallery->save();
            }
        }
        #Exterior Image Gallery
        if($request->hasFile('exterior_images'))
        {
            foreach($request->file('exterior_images') as $file)
            {
                $image = Image::make($file);
                $extension = $file->getClientOriginalExtension();
                $dir = 'assets/images/property/exterior/';
                $gallery_name = '_' . uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
                $image->insert($watermark, 'bottom-right', 5, 5);
                $image->save(public_path($dir.$gallery_name));
                $gallery = new PropertyExteriorGallery;
                $gallery->directory = $gallery_name;
                $gallery->property_id = $propertyId;
                $gallery->company_id = Auth::user()->company_id;
                $gallery->save();
            }
        }
    }
    public function getProperty($slug){
        return Property::where('slug', $slug)->first();

    }

    public function getPropertyById($id){
        return Property::find($id);
    }


}
