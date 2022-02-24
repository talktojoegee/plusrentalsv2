<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskCategory extends Model
{
    use HasFactory;



    /*
     * Use-case methods
     */
    public function setNewCategory(Request $request){
        $category = new TaskCategory();
        $category->task_category_name = $request->category_name ?? '';
        $category->company_id = Auth::user()->company_id;
        $category->save();
    }
    public function updateCategory(Request $request){
        $category = TaskCategory::find($request->category);
        $category->task_category_name = $request->category_name ?? '';
        $category->save();
    }

    public function getAllTaskCategories(){
        return TaskCategory::orderBy('task_category_name', 'ASC')->get();
    }
}
