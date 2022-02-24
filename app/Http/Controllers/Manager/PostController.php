<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostAssociateCategory;
use App\Models\PostCategory;
use App\Models\PostComment;
use App\Models\ProjectAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:manager');
        $this->post = new Post();
        $this->postcategory = new PostCategory();
        $this->postassociatecategory = new PostAssociateCategory();
    }
    public function manageAllPosts(){
        return view('superadmin.blog.index',[
            'posts'=>$this->post->getAllPosts()
        ]);
    }

    public function showAddNewPostForm(){
        return view('superadmin.blog.add-new-post',[
            'categories'=>$this->postcategory->getAllPostCategories()
        ]);
    }

    public function setNewPost(Request $request){
        $this->validate($request,[
            'post_title'=>'required',
            'post_content'=>'required',
            'post_category'=>'required',
            'featured_image'=>'required'
        ],[
            'post_title.required'=>'Enter post title',
            'post_content.required'=>'Enter post content',
            'post_category.required'=>'Select post category',
            'featured_image.required'=>'Choose featured image'
        ]);
        $post = $this->post->setNewPost($request);
        $this->postassociatecategory->setNewPostAssociateCategory($request, $post->id);
        session()->flash("success", "<strong>Great!</strong> Your article posted successfully.");
        return back();
    }

    public function showUpdatePostForm($slug){
        $post = $this->post->getPostBySlug($slug);
        if(!empty($post)){
            $catIds = [];
            foreach($post->getPostAssociateCategories as $cat){
                array_push($catIds, $cat->category_id);
            }
            return view('superadmin.blog.view', [
                'post'=>$post,
                'categories'=>$this->postcategory->getAllPostCategories(),
                'catIds'=>$catIds]);
        }else{
            session()->flash("error", "<strong>Whoops!</strong> No record found.");
            return back();
        }
    }
    public function updatePost(Request $request){
        $this->validate($request,[
            'post_title'=>'required',
            'post_content'=>'required',
            'post_category'=>'required',
            'featured_image'=>'required'
        ],[
            'post_title.required'=>'Enter post title',
            'post_content.required'=>'Enter post content',
            'post_category.required'=>'Select post category',
            'featured_image.required'=>'Choose featured image'
        ]);
        $post = $this->post->updatePost($request);
        $this->postassociatecategory->updatePostAssociateCategory($request, $post->id);
        session()->flash("success", "<strong>Great!</strong> Your changes were saved successfully.");
        return back();
    }


    public function addNewCategory(Request $request){
        $this->validate($request,[
            'category_name'=>'required'
        ]);
        $this->postcategory->setNewCategoryName($request);
        return view('superadmin.blog.partial._categories', ['categories'=>$this->postcategory->getAllPostCategories()]);
    }
}
