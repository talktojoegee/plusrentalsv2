<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Faq extends Model
{
    use HasFactory;

    /*
     * Use-case methods
     */
    public function setNewFAQ(Request $request){
        $faq = new Faq();
        $faq->answer = $request->answer ?? '';
        $faq->question = $request->question ?? '';
        $faq->added_by = Auth::user()->id; //admin user
        $faq->save();
    }

    public function updateFAQ(Request $request){
        $faq =  Faq::find($request->faq);
        $faq->answer = $request->answer ?? '';
        $faq->question = $request->question ?? '';
        $faq->added_by = Auth::user()->id; //admin user
        $faq->save();
    }

    public function getAllFAQs(){
        return Faq::orderBy('question', 'ASC')->get();
    }

    public function getFAQById($id){
        return Faq::find($id);
    }
}
