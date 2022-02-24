<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    public function getPostAuthor(){
        return $this->belongsTo(Admin::class, 'author_id');
    }

    public function getPostAssociateCategories(){
        return $this->hasMany(PostAssociateCategory::class, 'post_id');
    }

    public function getPostComments(){
        return $this->hasMany(PostComment::class, 'post_id');
    }

    /*
     * Use-case methods
     */

    public function getAllPosts(){
        return Post::orderBy('id', 'DESC')->get();
    }

    public function getPostBySlug($slug){
        return Post::where('slug', $slug)->first();
    }

    public function getPostsByIds($postArrayIds){
        return Post::whereIn('id', $postArrayIds)->get();
    }

    public function setNewPost(Request $request){
        $filename = '';
        if($request->hasFile('featured_image')){
            $extension = $request->featured_image->getClientOriginalExtension();
            $filename = Str::slug($request->post_title).'_' . uniqid(). '.' . $extension;
            $dir = 'assets/drive/';
            $request->featured_image->move(public_path($dir), $filename);
        }
        $post = new Post();
        $post->post_title = $request->post_title;
        $post->author_id = Auth::user()->id;
        $post->post_content = $request->post_content;
        $post->slug = Str::slug($request->post_title).'-'.substr(sha1(time()),33,40);
        $post->featured_image = $filename;
        $post->save();
        return $post;
    }
    public function updatePost(Request $request){
        $filename = '';
        if($request->hasFile('featured_image')){
            $extension = $request->featured_image->getClientOriginalExtension();
            $filename = Str::slug($request->post_title).'_' . uniqid(). '.' . $extension;
            $dir = 'assets/drive/';
            $request->featured_image->move(public_path($dir), $filename);
        }
        $post = Post::find($request->post);
        $post->post_title = $request->post_title;
        $post->author_id = Auth::user()->id;
        $post->post_content = $request->post_content;
        $post->slug = Str::slug($request->post_title).'-'.substr(sha1(time()),33,40);
        $post->featured_image = $filename;
        $post->save();
        return $post;
    }

    public function uploadPostAttachments(Request $request, $project_id){
        if($request->hasFile('featured_image'))
        {
            foreach($request->file('featured_image') as $file)
            {
                $extension = $file->getClientOriginalExtension();
                $size = $file->getSize();
                $filename = Str::slug($request->post_title).'_' . uniqid(). '.' . $extension;
                $dir = 'assets/drive/';
                $file->move(public_path($dir), $filename);

                $attach = new ProjectAttachment();
                $attach->project_id = $project_id;
                $attach->attachment = $filename;
                $attach->size = $size;
                $attach->slug = substr(sha1(time()),30,40);
                $attach->save();
            }
        }
    }
}
