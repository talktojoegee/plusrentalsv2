<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Theme extends Model
{
    use HasFactory;


    /*
     * Use-case methods
     */

    public function getThemes(){
        return Theme::orderBy('theme_name', 'ASC')->get();
    }

    public function uploadNewTheme(Request $request){
        if(!empty($request->file('attachment'))){
            $extension = $request->file('attachment');
            $extension = $request->file('attachment')->getClientOriginalExtension();
            $size = $request->file('attachment')->getSize();
            $dir = 'assets/drive/theme/';
            $filename = uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
            $request->file('attachment')->move(public_path($dir), $filename);
        }else{
            $filename = '';
        }
        $theme = new Theme;
        $theme->theme = $filename;
        $theme->theme_name = $request->name;
        $theme->color_scheme =  $request->scheme == 1 ? '#8B9198' : '#FFFFFF';
        $theme->save();
        $themeId = $theme->id;
        if($request->custom == 'yes'){
            $user = User::find(Auth::user()->id);
            $user->active_theme = $themeId;
            $user->save();
        }
    }
}
