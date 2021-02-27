<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class OrderDetailModel extends Model
{
    //
    protected $table = "orderdetail";
    protected $primaryKey = "id";
    protected $guarded = [];


    public function Order(){
        return $this->belongsTo(OrderModel::class);
    }
}
