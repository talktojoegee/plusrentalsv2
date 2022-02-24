<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EmailTemplate as ETemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class EmailTemplate extends Model
{
    use HasFactory;
    protected $fillable = [
        'template_name','subject', 'body', 'slug'
    ];



    /*
     * Use-case methods
     */

    public function getAllEmailTemplates(){
        return ETemplate::orderBy('template_name')->get();
    }

    public function setNewEmailTemplate(Request $request){
        $slug = Str::slug($request->subject).substr(sha1(time()),32,40);
        $template = new ETemplate();
        $template->subject = $request->subject ?? '';
        $template->body = $request->body ?? '';
        $template->slug = $slug ?? '';
        $template->template_name = $request->template_name ?? '';
        $template->save();
    }

    public function editNewEmailTemplate(Request $request){
        $template = ETemplate::find($request->template);
        $template->subject = $request->subject ?? '';
        $template->body = $request->body ?? '';
        $template->template_name = $request->template_name ?? '';
        $template->save();
    }


    public function getEmailTemplateBySlug($slug){
        return ETemplate::where('slug', $slug)->first();
    }


}
