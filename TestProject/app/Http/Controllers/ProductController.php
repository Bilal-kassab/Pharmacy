<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=Product::get();
        return response()->json([
            'data'=>$products,
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createProduct(Request $req)
    {
        $req->validate([
            'name'=>'required',
            'trade_name'=>'required',
            'date'=>'required',
            'company'=>'required',
            'price'=>'required',
            'amount'=>'required',
            'category_id'=>'required',
        ]);

        if($req->price<0){
            return response()->json(['price can not be under zero'],403);
        }
        
        $product=Product::create([
            'name'=>$req->name,
            'trade_name'=>$req->trade_name,
            'date'=>$req->date,
            'company'=>$req->company,
            'price'=>$req->price,
            'amount'=>$req->amount,
            'category_id'=>$req->category_id,
            'user_id'=>auth()->user()->id,
        ]);
        
        return response()->json([
            'data'=>$product,
        ],200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function search(Request $request)
    {
        $request->validate([
            'name'=>'required'
        ]);
    //    $product_name=Product::where('name',$request->name)->first();
    $product_name=Product::where('name','like','%'.$request->name.'%')->get();

       return response()->json([
        'data'=>$product_name,
       ],200);
    }

    public function productCategories(Request $request){// إعادة أدوية حسب التصنيف
        $request->validate([
            'id'=>'required'
        ]);
        $products=Product::where('category_id',$request->id)->get();
        return response()->json([
            'data'=>$products,
           ],200);
    }


   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
