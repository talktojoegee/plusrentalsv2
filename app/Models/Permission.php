<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;


    /*
     * Use-case methods
     */
    public function getAllPermissions(){
        return Permission::orderBy('name', 'ASC')->get();
    }
}
