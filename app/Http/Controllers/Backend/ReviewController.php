<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\ReviewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
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
        //$search_catagory_name = $request->query('search_catagory_name', "");
        $product_id = $request->input("product_id","");

        $reviews = DB::table('review');
        if($request->hasAny("product_id")){
            $reviews = $reviews->where("product_id", $product_id);
        }
        $reviews = $reviews->orderBy("created_at","desc")->paginate(10);

        return view('backend.Review.index', compact(['reviews', 'product_id']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.Review.create");
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
        $validate = $request->validate([
            'product_id' => 'required',
            'name' => 'required',
            'content' => 'required',
            'rate' => 'required|min:1|max:5|numeric',
        ]);
        $path = $request->file('avatar', "")->store("public/img_review");
        // CatagoryModel::create($request->all());
        $review = new ReviewModel();
        $review->product_id = $request->input('product_id', "");
        $review->name = $request->input('name', "");
        $review->content = $request->input('content', "");
        $review->rating = $request->input('rate', "");
        $review->avatar = $path;
        echo "đây là store";
        $review->save();
        return redirect()
            ->route("Review.index")
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
        //
        echo "bye";
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
        echo "hello";
        dd($id);
        $review = ReviewModel::findOrFail($id);
        $review->delete();
        return redirect()
            ->route("Review.index")
            ->with("status", "Create success");
    }

    public function delete($id){
        print_r($id);
        $review = ReviewModel::findOrFail($id);
        $review->delete();
        return redirect()
            ->route("Review.index")
            ->with("status", "Create success");
        // return redirect(route("Review.destroy",[$id,$_method]));
    }
}
