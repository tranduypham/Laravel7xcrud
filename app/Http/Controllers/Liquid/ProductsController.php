<?php

namespace App\Http\Controllers\Liquid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Backend\ProductModel;
use App\Models\Frontend\CartModel;

class ProductsController extends Controller
{
    //
    private $cart;
    public function __construct()
    {
        //Lấy thông tin giỏ hàng
        $this->cart = new CartModel([
            // Can add unlimited number of item to cart
            'cartMaxItem'      => 0,

            // Set maximum quantity allowed per item to 99
            'itemMaxQuantity'  => 99,

            // Do not use cookie, cart data will lost when browser is closed
            'useCookie'        => false,
        ]);
        $totalItem = $this->cart->getTotalItem();
        // $totalPrice = 0;
        // $allItems = $this->cart->getItems();
        // foreach($allItems as $items){
        //     foreach($items as $item){
        //         $id = $item["id"];
        //         if($id>0){
        //             $totalPrice += (int)ProductModel::findOrFail($id)->product_price || 0;
        //         }
        //     }
        // }
        view()->share('totalItem', $totalItem);
        // view()->share('totalPrice', $totalPrice);

        // Lấy danh sách bán chạy
        $bestSellers = DB::table('orderdetail')->groupBy("product_id")->selectRaw("sum(quantity) as sum,product_id")->orderBy("sum","desc")->take(3)->get();
        $best = [];
        foreach($bestSellers as $bestSeller){
            $best[] = $bestSeller->product_id;
        }
        // Lấy danh sách hàng mới về
        $newArriveds = DB::table('products')->orderBy("created_at","asc")->take(2)->get();
        $new = [];
        foreach($newArriveds as $newArrived){
            $new[] = $newArrived->id;
        }
        // Lấy danh sách blog
        $blogs = DB::table('blog')->orderBy("created_at","desc")->take(4)->get();
        view()->share('blogs',$blogs);
        view()->share('bestSeller', $best);
        view()->share('newArrived', $new);
    }

    public function index(){
        // Lấy danh sách danh mục
        $catagories = DB::table('catagory')->select("id","catagory_name")->get();
        //Lấy danh sách sản phẩm
        $products = DB::table('products')
            ->join("catagory","products.catagory_id","=","catagory.id")
            ->select("products.id","catagory_name","products.product_image","products.product_price","products.product_name","sale")
            ->paginate(9);
        // $product = ProductModel::with("Catagory")->select("products.id","products.product_name","catagory_id")->first();
        // dd($product);
        return view("Liquid.site.products",compact(["catagories","products"]));
    }


    public function index_catagory($catagory){
        // Lấy danh sách danh mục
        $catagories = DB::table('catagory')->select("id","catagory_name")->get();
        //Lấy danh sách sản phẩm
        $products = DB::table('products')
            ->join("catagory","products.catagory_id","=","catagory.id")
            ->select("products.id","catagory_name","products.product_image","products.product_price","products.product_name","sale")
            ->where("catagory.id",$catagory)
            ->paginate(9);
        return view("Liquid.site.products",compact(["catagories","products"]));
    }
    public function index_catagory_multi(Request $request){
        $cata = $request->input("catalog","");
        $cata = explode(",",$cata);
        // echo "hello";
        // dd($cata);
        // die;
        // Lấy danh sách danh mục
        $catagories = DB::table('catagory')->select("id","catagory_name")->get();
        //Lấy danh sách sản phẩm
        $products = DB::table('products')
            ->join("catagory","products.catagory_id","=","catagory.id")
            ->select("products.id","catagory_name","products.product_image","products.product_price","products.product_name","sale")
            ->whereIn("catagory_name",$cata)
            ->paginate(9);
        return view("Liquid.site.products-detail",compact(["catagories","products"]))->render();
    }



    public function fetch(Request $request){
        // Lấy danh sách danh mục
        $catagories = DB::table('catagory')->select("id","catagory_name")->get();
        //Lấy danh sách sản phẩm
        $products = DB::table('products')
            ->join("catagory","products.catagory_id","=","catagory.id")
            ->select("products.id","catagory_name","products.product_image","products.product_price","products.product_name","sale")
            ->paginate(9);
        // $product = ProductModel::with("Catagory")->select("products.id","products.product_name","catagory_id")->first();
        // dd($product);
        $view = view("Liquid.site.products-detail",compact(["catagories","products"]))->render();
        // dd($view);
        return response($view,200);
    }


    public function show($id){
        // Lấy danh sách danh mục
        $sell = DB::table('orderdetail')->groupBy("product_id")->having("product_id",$id)->selectRaw("sum(quantity) as sum")->get();
        //Lấy danh sách sản phẩm
        $product = DB::table('products')
            ->join("catagory","products.catagory_id","=","catagory.id")
            ->select("products.id","catagory_name","products.product_image","products.product_price","products.product_name","sale","product_desc","products.product_quantity")
            ->where("products.id",$id)
            ->first();
        // Lấy danh sách review
        $reviews = DB::table('review')->where("product_id",$id)->get();
        if(count($reviews)>0){
            foreach($reviews as $review){
                $review->avatar = str_replace("public/","storage/",$review->avatar);
            }
        }
        $product->product_image = str_replace("public/","storage/",$product->product_image);
        $SELL = 0;
        foreach($sell as $a){
            if($a!=null){
                $SELL = $a->sum;
            }
        }
        return view("Liquid.site.single-product",compact(["SELL","product","reviews"]));
    }
}
