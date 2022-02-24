<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:manager');
        $this->faq = new Faq();
        //$this->newsletter = new Newsletter();
    }


    public function manageFaqs(){
        return view('superadmin.faqs.index',['faqs'=>$this->faq->getAllFAQs()]);
    }

    public function showAddNewQuestionAnswerForm(){
        return view('superadmin.faqs.add-new-question-answer');
    }

    public function showUpdateQuestionAnswerForm($id){
        $faq = $this->faq->getFAQById($id);
        if(!empty($faq)){

            return view('superadmin.faqs.update-question-answer',['faq'=>$faq]);
        }else{
            session()->flash("error", "<strong>Whoops!</strong> No record found.");
            return back();
        }
    }

    public function storeNewFAQ(Request $request){
        $this->validate($request,[
            'question'=>'required',
            'answer'=>'required'
        ],[
            'question.required'=>'Enter question here',
            'answer.required'=>"What's the answer to this question"
        ]);
        $this->faq->setNewFAQ($request);
        session()->flash("success", "<strong>Success!</strong> New FAQ registered");
        return back();
    }
    public function updateFAQ(Request $request){
        $this->validate($request,[
            'question'=>'required',
            'answer'=>'required',
            'faq'=>'required'
        ],[
            'question.required'=>'Enter question here',
            'answer.required'=>"What's the answer to this question"
        ]);
        $this->faq->updateFAQ($request);
        session()->flash("success", "<strong>Success!</strong> Changes saved.");
        return back();
    }

    /*public function manageNewsletter(){
        return view('manager.newsletter.index',['newsletters'=>$this->newsletter->getAllNewsletters()]);
    }*/
}
