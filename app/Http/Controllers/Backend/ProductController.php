<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\CatagoryModel;
// Đây là namespace của model này
use App\Models\Backend\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware("backend_authenticate");
    }
    //Phương thức delete
    //Xóa một phần tử
    public function delete($id)
    {
        $product = ProductModel::findOrFail($id);
        $data = [];
        $data["product"] = $product;

        return view("backend.products.delete", $data);
    }
    // Phương thức destroy để thực sự xóa phần tử
    public  function destroy($id)
    {
        echo $id;

        $product = ProductModel::findOrFail($id);
        $product->delete();

        return redirect("/backend/product/delete")->with('status', 'Sản phẩm đã bị xóa');
    }
    //Phương thức edit
    // Thực hiện chỉnh sửa dữ liệu
    public function edit($id)
    {
        // echo $id;
        //Model::findOrFail dùng để tìm kiếm dựa theo 1 id có sẵn
        $product = ProductModel::findOrFail($id);
        // $product = ProductModel::where('product_name','likes',$id)->firstOrFail();
        // echo "<pre>";
        // print_r($product);
        // echo "</pre>";
        // die;
        $catagory = DB::table('catagory')->pluck('catagory_name', 'id');
        $data["product"] = $product; //Cái chữ product ở data để đến khi gửi data xuống file edit, ta sẽ truy suất cái thuộc tính bằng biến $product
        $data["catagory"] = $catagory;
        // die;
        return view("backend.products.edit", $data);
    }
    //Hàm update để thực hiện update dữ liệu sau khi edit
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'product_name' => 'required',
            'product_desc' => 'required',
            'product_quantity' => 'required',
            'product_price' => 'required',
            'catagory_id' => 'required',
        ]);
        // echo "hello";
        echo "<pre>";
        print_r($request->input());
        echo "</pre>";


        $product_name = $request->input('product_name', "NO NAME");
        // $product_image = $request->input('product_image',"");
        $product_publish = $request->input('product_publish', date("Y-m-d H:i:s"));
        $product_quantity = $request->input('product_quantity', 0);
        $product_price = $request->input('product_price', 0);
        $product_desc = $request->input('product_desc', "");
        $product_status = $request->input('product_status', 1);
        $product_catagory_id = $request->input('catagory_id', 0);

        if (!$product_publish) {
            $product_publish = date("Y-m-d H:i:s");
        }

        $PRODUCT_SAVE = ProductModel::findOrFail($id);

        $PRODUCT_SAVE->product_name = $product_name;
        if ($request->hasFile('product_image')) { //Nếu có file upload lên thì mới gán vào, không thì khồng update trường này
            if ($PRODUCT_SAVE->product_image) { //Nếu trong biến này có ảnh => đây là trường hợp thay thế ảnh mới
                Storage::delete($PRODUCT_SAVE->product_image); //Ta sẽ xóa ảnh cũ trong file public/storage/img đi
            }
            $pathProductImage = $request->file('product_image')->store('public/img'); //thực hiện lưu ảnh mới vào storage
            $PRODUCT_SAVE->product_image = $pathProductImage; //Copy đường dẫn vào biến model->image
        }
        $PRODUCT_SAVE->product_publish = $product_publish;
        $PRODUCT_SAVE->product_quantity = $product_quantity;
        $PRODUCT_SAVE->product_price = $product_price;
        $PRODUCT_SAVE->product_desc = $product_desc;
        $PRODUCT_SAVE->product_status = $product_status;
        $PRODUCT_SAVE->catagory_id = $product_catagory_id;

        $PRODUCT_SAVE->save();

        return redirect("/backend/product/edit/$id")->with('status', 'Cập nhật thành công');
    }
    // Phương thức index
    // List danh sách sản phẩm từ csdl
    public function index(Request $request)
    {

        // var_dump($request->cookie("admin_login_remember"));

        // dd($request->cookie("admin_login_remember"));
        // $products = ProductModel::all();
        //Giói hạn mỗi trang chỉ có 10 bản ghi
        //Phải viết join trc rồi mới viết where (Hiểu nôm na cái join nó ở trong Form, diễn ra ở trc cái where)
        $products = DB::table('products')
        ->join('catagory', function($join){
            $join->on('catagory.id','products.catagory_id');
        })
        ->select('products.id','products.catagory_id as catagory_id','catagory.catagory_name as catagory_name','product_name','product_image','product_desc','product_publish','product_quantity','product_price','product_status');
        $search_product_name = $request->query('search_product_name', "");
        // $products = DB::table('products')->paginate(10);
        // $products = ProductModel::where('product_name', "LIKE", "%" . $search_product_name . "%");
        $products = $products->where('product_name', "LIKE", "%" . $search_product_name . "%");
        // $products = ProductModel::where('product_name', "LIKE", "a" . "%")
        //     ->where("id", ">", "50")
        //     ->paginate(10);

        // Phân loại theo danh mục
        $catagory = DB::table('catagory')->pluck('catagory_name', 'id');
        $data["catagory"] = $catagory;
        $product_catagory_id = $request->query('catagory_id', "");
        $data["product_catagory_id"] = $product_catagory_id;
        if ($request->hasAny('catagory_id')) {
            $products->where('catagory_id', $product_catagory_id);
        }
        //Phân loại theo trạng thái sản phẩm
        $product_status = $request->query('product_status', "");
        if ($request->hasAny('product_status')) { //Kiểm tra xem trong request có cái product_status không
            $products = $products->where('product_status', $product_status);
        }
        $data["product_status"] = $product_status;
        //Phân loại theo sắp
        $product_sort = $request->query('product_sort', "");
        if ($request->hasAny('product_sort')) { //Kiểm tra xem trong request có cái product_sort không
            switch ($product_sort) {
                case "price_asc":
                    $products = $products->orderBy('product_price', "asc");
                case "price_desc":
                    $products = $products->orderBy('product_price', "desc");
                case "quantity_asc":
                    $products = $products->orderBy('product_quantity', "asc");
                case "quantity_desc":
                    $products = $products->orderBy('product_quantity', "desc");
            }
        }
        $data["product_sort"] = $product_sort;
        $products = $products->paginate(5);
        // echo "<pre>";
        // print_r($products);
        // echo "</pre>";
        // die;
        // die;
        $data["products"] = $products; //Truyền toàn bộ mảng đi

        // Truyền thêm biến này xuống, vì mỗi lần nhấn search là 1 lần gọi đến ídex, trang bị reload, mất từ mà người dùng tìm kiếm
        $data["search"] = $search_product_name;
        return view("backend.products.index", $data);
    }
    public function create()
    {
        // $catagory = CatagoryModel::all();
        $catagory = DB::table('catagory')->pluck('catagory_name', 'id');
        return view("backend.products.create", compact('catagory'));
    }
    //Phương thức store,
    // Lưu sản phẩm sau khi đã sửa hoặc tạo mới
    public function store(Request $request)
    {

        // Validate dữ liệu
        $validateData = $request->validate([
            'product_name' => 'required',
            'product_desc' => 'required',
            'product_quantity' => 'required',
            'product_price' => 'required',
            'product_image' => 'required',
            'catagory_id' => 'required',

        ]);
        //Trả về vị trí lưu ảnh bên trong folder
        $pathProductImage = $request->file('product_image')->store('public/img');
        // var_dump($pathProductImage);
        // die;
        // Cái validate này sẽ ngăn không cho trang chạy tiếp nếu mấy thằng ở trên không được nhập đầy đủ

        // Lấy dữ liệu từ Request
        $product_name = $request->input('product_name', 'không có');
        // $product_image = $request->input('product_image', 'rỗng');
        $product_image = $pathProductImage;
        $product_publish = $request->input('product_publish', date("Y-m-d H:i:s"));
        $product_quantity = $request->input('product_quantity', '0');
        $product_price = $request->input('product_price', '0');
        $product_desc = $request->input('product_desc', '12'); //Chỉ khi nào không submit một dữ liệu nào đó đi thì mới sử dụng giá trị default
        $product_status = $request->input('product_status', 1);
        $product_catagory_id = $request->input('catagory_id', 00);



        // Khởi tạo một model mới
        $product = new ProductModel(); //Thông thường model được tạo ra sẽ mặc định nằm trong chính folder app, ở đây ta đặt model vào file Models/Backend

        // Nếu không nhập ngày tháng
        if (!$product_publish) {
            $product_publish = date("Y-m-d H:i:s");
        }
        // Gán dữ liệu submit trong request cho các biến của Product
        // $product là đối tượng khởi tạo từ model ProductModel
        // date_default_timezone_set('Asia/Ho_Chi_Minh');
        $product->product_status = $product_status;
        $product->product_name = $product_name;
        // $product->product_image = $product_image;
        $product->product_image = $product_image;
        $product->product_publish = $product_publish;
        $product->product_quantity = $product_quantity;
        $product->product_price = $product_price;
        $product->product_desc = $product_desc;
        $product->catagory_id = $product_catagory_id;



        // Lưu sản phẩm
        $product->save();
        // Return về trang index
        return redirect("/backend/product/index")->with('status', 'Lưu dữ liệu thành công');
    }
}
