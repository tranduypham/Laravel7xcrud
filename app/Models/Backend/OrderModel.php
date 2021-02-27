<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    //Thông thường người ta thường đặt tên model là tên bảng luôn thì ta sẽ không cần phải khai báo biến $table nữa
    // Nên khai báo ra
    protected $table = "orders";
    protected $primaryKey = "id";
    protected $guarded = [];

    public function OrderDetail(){
        return $this->belongsTo(OrderDetailModel::class);
    }

    // public function getOrderStatusAttribute($attribute){
    //     return[
    //         0 => 'Inactive',
    //         1 => 'Active'
    //     ] [$attribute];
    // }
}
