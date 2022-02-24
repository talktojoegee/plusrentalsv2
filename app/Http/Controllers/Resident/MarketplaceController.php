<?php

namespace App\Http\Controllers\Resident;

use App\Models\Ad;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MarketplaceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function marketplace()
    {
        $now = now();
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $adverts = Ad::orderBy('id', 'DESC')->paginate(20);
        foreach($adverts as $advert){
            if(strtotime($advert->end_date) > strtotime($now)){
                $advert->status = 1;
                $advert->save();
            }else{
                $advert->status = 4;
                $advert->save();
            }
        }
        return view('home',['categories'=>$categories, 'adverts'=>$adverts]);
    }
}
