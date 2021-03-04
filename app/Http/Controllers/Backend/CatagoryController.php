<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\CatagoryModel;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Backend\ProductModel;


class CatagoryController extends Controller
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
        $search_catagory_name = $request->query('search_catagory_name', "");

        $catagories = CatagoryModel::where("catagory_name", 'like', "%" . $search_catagory_name . "%");
        $catagories = $catagories->paginate(5);

        return view('backend.catagory.index', compact(['catagories', 'search_catagory_name']))
            ->with("i", ((request()->query('page', 1) - 1) * 5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Không hiểu sao nếu có cái dòng echo này thì bị mất cái tab Document => lỗi chỗ edit
        // echo "đây là create";
        return view('backend.catagory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'catagory_name' => 'required',
            'catagory_image' => 'required',
            'catagory_slug' => 'required',
            'catagory_desc' => 'required',
        ]);
        $path = $request->file('catagory_image', "")->store("public/img_catagory");
        // CatagoryModel::create($request->all());
        $catagory = new CatagoryModel();
        $catagory->catagory_name = $request->input('catagory_name', "");
        $catagory->catagory_slug = $request->input('catagory_slug', "");
        $catagory->catagory_desc = $request->input('catagory_desc', "");
        $catagory->catagory_image = $path;
        echo "đây là store";
        $catagory->save();
        return redirect()
            ->route("catagory.index")
            ->with("status", "Create success");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $catagory = CatagoryModel::findOrFail($id);
        return view("backend.catagory.show", compact('catagory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $catagory = CatagoryModel::findOrFail($id);
        return view('backend.catagory.edit', compact('catagory'));
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
        echo "đây là update";
        // die;
        $validate = $request->validate([
            'catagory_name' => 'required',
            'catagory_slug' => 'required',
            'catagory_desc' => 'required',
        ]);
        // CatagoryModel::create($request->all());
        $catagory = CatagoryModel::findOrFail($id);
        $catagory->catagory_name = $request->input('catagory_name', "");
        $catagory->catagory_slug = $request->input('catagory_slug', "");
        $catagory->catagory_desc = $request->input('catagory_desc', "");
        if($request->hasFile('catagory_image')){
            $path = $request->file('catagory_image')->store("public/img_catagory");
            Storage::delete($catagory->catagory_image);
            $catagory->catagory_image = $path;
        }
        $catagory->save();
        // die;
        return redirect()
            ->route("catagory.index")
            ->with("status", "Update success");
    }
    public function delete($id)
    {
        $catagory = CatagoryModel::findOrFail($id);
        return view('backend.catagory.delete', compact('catagory'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = DB::table('products')->where('catagory_id',$id);
        // $products = ProductModel::where('catagory_id',$id);
        print_r($products->count()) ;
        // die;
        if($products->count()==0){
            $catagory = CatagoryModel::findOrFail($id);
            $catagory->delete();
            return redirect()
                ->route('catagory.index')
                ->with('status', 'Xóa danh mục thành công');
        }else{
            // echo "hello";
            // die;
            return redirect(url("/backend/product/delete/$id"))
                ->with('status', 'Phải xóa hết các sản phẩm trong danh mục trước đã');
        }

    }
}
