<?php

namespace App\Http\Controllers\Resident;
use App\Notifications\NewReviewNotification;
use App\Models\AdComment;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Location;
use App\Models\Area;
use App\Models\Ad;
use App\Models\AdsGallery;
use App\Models\Wishlist;
use App\Models\AdsReview;
use App\Models\Customer;
use Carbon\Carbon;
use Image;

use Auth;

class AdsController extends Controller
{
   public function __construct(){
       $this->middleware('auth:tenant');
   }


   public function showPostAdsForm(){
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $locations = Location::orderBy('location_name', 'ASC')->get();
        $packages = Package::orderBy('amount', 'ASC')->get();
       return view('advert.post-your-ad',['categories'=>$categories,'locations'=>$locations,'packages'=>$packages]);
   }
/*
   public function postAdsConfirmation(Request $request){
       $this->validate($request,[
           'title'=>'required',
           'description'=>'required',
           'category'=>'required',
           'sub_category'=>'required',
           'location'=>'required',
           'area'=>'required',
           'price'=>'required',
           'featured_image'=>'required'
       ]);
       $location = Location::find($request->location);
       $area = Area::find($request->area);
       $category = Category::find($request->category);
       $subcategory = SubCategory::find($request->sub_category);
       $data = [
            'body'=>$request->all(),
           'location'=>$location,
           'area'=>$area,
           'category'=>$category,
           'subcategory'=>$subcategory
       ];
       return view();
   }*/
   public function postAds(Request $request){
       $this->validate($request,[
           'title'=>'required',
           'description'=>'required',
           'category'=>'required',
           'subcategory'=>'required',
           'location'=>'required',
           'area'=>'required',
           'price'=>'required',
           'featured_image'=>'required',
           //'package'=>'required',
       ]);
        $featured_image = null;
        $watermark = public_path('/images/watermark.png');

        if (!empty($request->file('featured_image'))) {
           $image = Image::make($request->file('featured_image'));
            $extension = $request->file('featured_image')->getClientOriginalExtension();
            $dir = 'attachments/featured-images/';
            $featured_image = '_' . uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $image->insert($watermark, 'bottom-right', 5, 5);
            $image->save(public_path($dir.$featured_image));
        } else {
            $featured_image = '';
        }
       $package = Package::find(1);
       //$package = Package::find($request->package);
       $current = Carbon::now();
       $ad = new Ad;
       $ad->title = $request->title;
       $ad->description = $request->description;
       $ad->price = $request->price;
       $ad->category_id = $request->category;
       $ad->sub_category_id = $request->subcategory;
       $ad->location_id = $request->location;
       $ad->area_id = $request->area;
       $ad->start_date = now();
       $ad->end_date = $current->addDays($package->duration);
       $ad->package_id = 1;//$request->package;
       $ad->customer_id = Auth::user()->id;
       $ad->negotiable = 1;
       $ad->featured_image = $featured_image;//'not-in-use';
       $ad->slug = Str::slug($request->title.'_'.substr(sha1(time()),32,40));
       $ad->save();
       $adId = $ad->id;
        if($request->hasfile('product_images'))
         {
            foreach($request->file('product_images') as $file)
            {
                $image = Image::make($file);
                 $extension = $file->getClientOriginalExtension();
                $dir = 'attachments/product-gallery/';
                $gallery_name = '_' . uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
                $image->insert($watermark, 'bottom-right', 5, 5);
                $image->save(public_path($dir.$gallery_name));
                $gallery = new AdsGallery;
                $gallery->directory = $gallery_name;
                $gallery->ads_id = $adId;
                $gallery->save();
            }
         }
       session()->flash("success", "<strong>Success!</strong> Your ads have been placed.");
       return redirect()->route('my-adverts');

   }

   public function getSubcategories(Request $request){
    $subcategories = SubCategory::where('category_id', $request->cat)->orderBy('sub_category_name', 'ASC')->get();
    return view('ads.partials._sub-categories',['subcategories'=>$subcategories]);
   }

   public function getAreas(Request $request){
    $areas = Area::where('location_id', $request->area)->orderBy('area_name', 'ASC')->get();
    return view('ads.partials._areas',['areas'=>$areas]);
   }


   public function myAdverts(){
       $adverts = Ad::where('customer_id', Auth::user()->id)->orderBy('id','DESC')->get();
       return view('ads.my-adverts', ['adverts'=>$adverts]);
   }

   public function advertDetail($slug){
       $advert = Ad::where('slug', $slug)/* ->where('status',1)->orWhere('status',0) */->first();
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

   }

   public function addToWishlist(Request $request){
       $request->validate([
           'customer'=>'required',
           'product'=>'required'
       ]);
       $product = Ad::find($request->product);
       if(!empty($product)){
           if(Auth::user()->id == $request->customer){
               $wishlist = Wishlist::where('product_id', $request->product)->where('customer_id', Auth::user()->id)->first();
               if(!empty($wishlist)){
                   return response()->json(['message'=>'Ooops! You already have this item in your wishlist. Please contact vendors to buy.'],200);
               }else{
                   $wishlist = new Wishlist;
                   $wishlist->customer_id = Auth::user()->id;
                   $wishlist->product_id = $request->product;
                   $wishlist->save();
                   return response()->json(['message'=>'Success! New item added to your wishlist.'],201);
               }
           }else{
               return response()->json(['error'=>'Error! An error occured. Try again later.'], 401);
           }
       }else{
           return response()->json(['error'=>'Error! No item found. Try again.'], 401);
       }
   }
   public function leaveComment(Request $request){
       $request->validate([
           'comment'=>'required',
           'advert'=>'required'
       ]);

       $comment = new AdComment;
       $comment->customer_id = Auth::user()->id;
       $comment->comment = $request->comment;
       $comment->advert_id = $request->advert;
       $comment->save();
       session()->flash("success", "<strong>Success!</strong> Comment registered.");
       return back();
   }

   public function wishlist(){
       $wishlists = Wishlist::where('customer_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
       return view('ads.wishlist',['wishlists'=>$wishlists]);
   }
/*    public function initializeSubcategories(Request $request){
    $subcategories = SubCategory::where('category_id', $request->cat)->orderBy('sub_category_name', 'ASC')->get();
    return response()->json(['subcategories'=>$subcategories],200);
   } */

   public function dropReview(Request $request){
       $this->validate($request,[
           'advert'=>'required',
           'review'=>'required',
           'rating'=>'required'
       ]);
       $advert = Ad::where('id', $request->advert)->first();
       if(!empty($advert)){
           $review = new AdsReview;
           $review->advert_id = $request->advert;
           $review->content = $request->review;
           $review->customer_id = Auth::user()->id;
           $review->rating = $request->rating ?? 1;
           $review->advertised_by = $advert->customer_id;
           $review->save();
           $customer = Customer::find($advert->customer_id);
            $customer->notify(new NewReviewNotification($review, $advert));
           session()->flash("success", "<strong>Success!</strong> Thank you for reviewing this ad.");
           return back();
       }else{
           session()->flash("error", "<strong>Ooops!</strong> No record found.");
           return back();
       }
   }
}
