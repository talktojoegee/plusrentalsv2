<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalOwner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','avatar','ownership_type',
        'surname','password','company_name',
        'first_name','email','created_at',
        'mobile_no','address','updated_at',
        'slug','gender','marital_status'
    ];



    /*
     * Use-case methods
     */

    public function getRentalOwnerByPropertyId($id){
        return RentalOwner::where('property_id', $id)->first();
    }

}
