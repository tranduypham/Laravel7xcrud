<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;


// Model trong laravel cho phép chúng ta có thể tương tác với 1 bảng trong CSDL và có thể thêm sửa xóa , lấy ra dữ liệu trong bảng đó mà không phải viết các câu SQL để truy vấn
class ProductModel extends Model
{
    //Khai báo tên Bảng mà mình giao tiếp trong models
    protected $table = 'products';

    // Khai báo khóa chính
    protected $primaryKey = 'id';
}
