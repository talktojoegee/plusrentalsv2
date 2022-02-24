<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostCategory extends Model
{
    use HasFactory;

    /*
    * Use-case methods
    */

    public function setNewCategoryName(Request $request){
        $cat = new PostCategory();
        $cat->category_name = $request->category_name;
        $cat->slug = Str::slug($request->category_name);
        $cat->save();
    }

    public function getAllPostCategories(){
        return PostCategory::orderBy('category_name', 'ASC')->get();
    }

    public function getCategoryBySlug($slug){
        return PostCategory::where('slug', $slug)->first();
    }
}
