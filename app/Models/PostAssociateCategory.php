<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PostAssociateCategory extends Model
{
    use HasFactory;

    public function getPostCategory(){
        return $this->belongsTo(PostCategory::class, 'category_id');
    }


    /*
     * Use-case methods
     */

    public function setNewPostAssociateCategory(Request $request, $postId){
        if(!empty($request->post_category)){
            foreach($request->post_category as $category){
                $cat = new PostAssociateCategory();
                $cat->post_id = $postId;
                $cat->category_id = $category;
                $cat->save();
            }
        }
    }
    public function updatePostAssociateCategory(Request $request, $postId){
        $post = PostAssociateCategory::where('post_id', $postId)->get();
        $postCatIds = [];
        foreach($post as $p){
            //array_push($postCatIds, $p->category_id);
            #Delete
            $p->delete();
        }
        if(!empty($request->post_category)){
            foreach($request->post_category as $category){
                $cat = new PostAssociateCategory();
                $cat->post_id = $postId;
                $cat->category_id = $category;
                $cat->save();
            }
        }
    }

    public function getAllPostsByCategoryId($id){
        return PostAssociateCategory::where('category_id', $id)->get();
    }
}
