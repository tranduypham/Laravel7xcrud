<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class CatagoryModel extends Model
{
    //
    protected $fillable = ['catagory_name', 'catagory_image', 'catagory_slug', 'catagory_parent_id', 'catagory_desc'];
    protected $table = 'catagory';
    protected $primaryKey = 'id';
}
