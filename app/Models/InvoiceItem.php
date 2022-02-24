<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\InvoiceItem as InvoiceItemModel;

class InvoiceItem extends Model
{
    use HasFactory;


    public function getService(){
        return $this->belongsTo(Service::class, 'service_id');
    }


    /*
     * Use-case methods
     */
    public function getInvoiceServicesByInvoiceId($id){
        return InvoiceItemModel::where('invoice_id', $id)->get();
    }
}
