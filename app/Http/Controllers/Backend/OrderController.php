<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\OrderDetailModel;
use App\Models\Backend\OrderModel;
use App\Models\Backend\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware("backend_authenticate");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $orders = DB::table('orders');
        $status = DB::table('order_status')->distinct()->get();
        $search_order_name = $request->query('search_order_name', "");
        $search_order_status = $request->query('search_order_status', "");
        if ($request->hasAny('search_order_name')) {
            $orders = $orders->where('custumer_name', 'like', "%$search_order_name%");
        }
        if ($request->hasAny('search_order_status')) {
            $orders = $orders->where('order_status', $search_order_status);
        }
        $orders = $orders->paginate(5);
        // dd("Đây là index");
        return view("backend.orders.index", compact(['orders', 'search_order_name', 'search_order_status', 'status']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $status = DB::table('orders')->distinct()->select('order_status')->get();
        $status = DB::table('order_status')->distinct()->get();

        return view("backend.orders.create", compact(['status']));
        // dd("Đây là create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'custumer_name' => 'required',
            'custumer_email' => 'required|email',
            'custumer_phone' => 'required|numeric',
            'custumer_address' => 'required',
            'total_price' => 'required|numeric',
            'order_status' => 'required|numeric',
            'product_id[*]' => 'required|numeric'
        ]);
        // echo "<pre>";
        // print_r($request->input());
        // echo "</pre>";
        $products_id = $request->input('product_id');
        $products_quantity = $request->input('product_quantity');
        // echo "<pre>";
        // print_r($products_id);
        // echo "</pre>";
        // // die;

        $request->input();
        $order = new OrderModel();
        $order->custumer_name = $request->input('custumer_name', "");
        $order->custumer_email = $request->input('custumer_email', "");
        $order->custumer_phone = $request->input('custumer_phone', "");
        $order->custumer_address = $request->input('custumer_address', "");
        $order->total_product = count(empty($products_id) ? [] : $products_id);
        $order->total_price = $request->input('total_price', 0);
        $order->order_status = $request->input('order_status', 0);
        $order->order_note = $request->input('order_note', "") || "";
        $order->save();
        foreach ($products_id as $index => $product_id) {
            // echo $order->id;
            // echo $products_id;
            // echo $products_quantity[$index];
            $orderDetail = new OrderDetailModel();
            $orderDetail->product_id = $product_id;
            $product = ProductModel::find($product_id);
            $orderDetail->product_price = $product->product_price;
            $orderDetail->quantity = $products_quantity[$index];
            $product->product_quantity = (int)$product->product_quantity - $products_quantity[$index];
            $product->save();
            $orderDetail->order_id = $order->id;
            $orderDetail->order_status = $order->order_status;
            $orderDetail->save();
        }

        // die;
        return redirect(route("orders.index"))->with('status', "Tạo đơn hàng thành công");
        // dd("Đây là store");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $order = DB::table('orders')->find($id);
        $status = DB::table('order_status')->distinct()->get();
        $orderDetails = DB::table('orderdetail')
            ->join('products', 'products.id', '=', 'orderdetail.product_id')
            ->where('orderdetail.order_id', $id)
            ->select("products.id as product_id", "products.product_price as product_price", "orderdetail.quantity as quantity", "orderdetail.order_id as order_id", "orderdetail.order_status as orrder_status", "products.product_image as product_image", "products.product_name", "orderdetail.id")
            ->get();
        $_status = [];
        foreach($status as $index => $value){
            $_status[$value->id] = $value->order_status;
        }
        return view("backend.orders.show",compact(['order','_status','orderDetails']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $order = DB::table('orders')->find($id);
        $orderDetails = DB::table('orderdetail')
            ->join('products', 'products.id', '=', 'orderdetail.product_id')
            ->where('orderdetail.order_id', $id)
            ->select("products.id as product_id", "products.product_price as product_price", "orderdetail.quantity as quantity", "orderdetail.order_id as order_id", "orderdetail.order_status as orrder_status", "products.product_image as product_image", "products.product_name", "orderdetail.id")
            ->get();
        $status = DB::table('order_status')->distinct()->get();
        // echo "<pre>";
        // print_r($orderDetail);
        // echo "</pre>";
        return view("backend.orders.edit", compact(['status', 'order', 'orderDetails']));
        // dd("Đây là edit" . $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'custumer_name' => 'required',
            'custumer_email' => 'required|email',
            'custumer_phone' => 'required|numeric',
            'custumer_address' => 'required',
            'total_price' => 'required|numeric',
            'order_status' => 'required|numeric',
            'product_id[*]' => 'required|numeric'
        ]);
        // echo "<pre>";
        // print_r($request->input());
        // echo "</pre>";
        $products_id = $request->input('product_id',[]);
        $products_quantity = $request->input('product_quantity',[]);
        $detail_id = $request->input('detail_id',[]);
        echo "<pre>";
        print_r($products_id);
        echo "</pre>";
        echo "<pre>";
        print_r($products_quantity);
        echo "</pre>";
        echo "<pre>";
        print_r($detail_id);
        echo "</pre>";
        var_dump(isset($detail_id[6]));
        // die;

        // $request->input();
        $order = OrderModel::findOrFail($id);
        $order->custumer_name = $request->input('custumer_name', "");
        $order->custumer_email = $request->input('custumer_email', "");
        $order->custumer_phone = $request->input('custumer_phone', "");
        $order->custumer_address = $request->input('custumer_address', "");
        $order->total_product = count(empty($products_id) ? [] : $products_id);
        $order->total_price = $request->input('total_price', 0);
        $order->order_status = $request->input('order_status', 0);
        $order->order_note = $request->input('order_note', "");
        $order->save();

        // Phần orderdetail
        $exist_detail = []; //Xét index những hàng bị sửa
        // Lấy danh sách các detail liên quan
        $orderDetails = DB::table('orderdetail')
            ->where('order_id', $id)
            ->get();

        // dump(count($orderDetails));
        // dump($orderDetails);
        // die;count($orderDetails) != 0

        // Xóa những detail đã bị xóa
        if (count($orderDetails) != 0) {//Nếu có tồn tại detail vs order id trong DB => Có khả năng phải xóa
            foreach ($orderDetails as $index => $value) {
                $id = $value->id;
                // dump(in_array($id, $detail_id));
                if (!in_array($id, $detail_id)) {
                    $detail = OrderDetailModel::find($id);
                    $product_id = $detail->product_id;
                    $product = ProductModel::find($product_id);
                    $product->product_quantity = (int)$product->product_quantity + $detail->quantity;
                    $product->save();
                    $detail->delete();
                }
            }
        }

        // Sửa những detail còn tồn tại
        // Nếu bẳng bảng detail id ko empty => có detail trong bảng cần phải sửa vào DB
        if (!empty($detail_id)) { //Có trường hợp tất cả mặt hàng trong bẳng là thêm mới => phần id detail sẽ là chuối rỗng
            foreach ($detail_id as $index => $value) {
                array_push($exist_detail, $index);
                $orderDetail = OrderDetailModel::find($value);
                $product = ProductModel::find($products_id[$index]);
                $orderDetail->product_id = $products_id[$index];
                $orderDetail->product_price = $product->product_price;
                $product->product_quantity = (int)$product->product_quantity + $orderDetail->quantity;
                $orderDetail->quantity = $products_quantity[$index];
                $product->product_quantity = (int)$product->product_quantity - $orderDetail->quantity;
                $orderDetail->order_id = $order->id;
                $orderDetail->order_status = $order->order_status;
                $orderDetail->save();
                $product->save();
            }
        }

        // Tạo những detail mới được thêm vào
        if (!empty($products_id)) { //Có trường hợp đơn hàng không có mặt hàng nào cả, mà foreach không xét chuỗi null
            foreach ($products_id as $index => $value) {
                if (in_array($index, $exist_detail)) {
                    continue;
                } else {
                    $orderDetail = new OrderDetailModel();
                    $product = ProductModel::find($products_id[$index]);
                    $orderDetail->product_id = $products_id[$index];
                    $orderDetail->product_price = $product->product_price;
                    $product->product_quantity = (int)$product->product_quantity + $orderDetail->quantity;
                    $orderDetail->quantity = $products_quantity[$index];
                    $product->product_quantity = (int)$product->product_quantity - $orderDetail->quantity;
                    $orderDetail->order_id = $order->id;
                    $orderDetail->order_status = $order->order_status;
                    $orderDetail->save();
                    $product->save();
                }
            }
        }
        return redirect(route("orders.index"))->with('status', "Sửa đơn hàng thành công");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $order = OrderModel::find($id);
        $orderDetails = OrderDetailModel::where('order_id',$id);
        foreach ($orderDetails as $orderDetail) {
            $product = ProductModel::find($orderDetail->product_id);
            $product->product_quantity = $orderDetail->quantity+$product->product_quantity;
            $product->save();
        }

        $order->delete();
        $orderDetails->delete();
        return redirect(route("orders.index"))->with('status',"Xóa đơn hàng thành công");
        dd("Đây là destroy" . $id);
    }
    public function delete($id)
    {
        //
        $order = DB::table('orders')->find($id);
        $status = DB::table('order_status')->distinct()->get();
        $orderDetails = DB::table('orderdetail')
            ->join('products', 'products.id', '=', 'orderdetail.product_id')
            ->where('orderdetail.order_id', $id)
            ->select("products.id as product_id", "products.product_price as product_price", "orderdetail.quantity as quantity", "orderdetail.order_id as order_id", "orderdetail.order_status as orrder_status", "products.product_image as product_image", "products.product_name", "orderdetail.id")
            ->get();
        $_status = [];
        foreach($status as $index => $value){
            $_status[$value->id] = $value->order_status;
        }
        return view("backend.orders.delete",compact(['order','_status','orderDetails']));
        // dd("Đây là delete" . $id);
    }

}
