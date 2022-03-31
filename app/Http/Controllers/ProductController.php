<?php

namespace App\Http\Controllers;

use App\Models\ModelProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ModelProduct::all();
        return response()->json([
            'success'   => true,
            'data'      => $data
        ])->setStatusCode(200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'product'   => "required|max:100"
        ],[
            'product.required' => "Product is required"
        ]);

        if($validate->fails()){
            return response()->json([
                'success'   => false,
                'message'   => $validate->errors()->first()
            ])->setStatusCode(200);
        }

        $product = ModelProduct::create([
            'product' => $request->product
        ]);

        $product->save();
        return response()->json([
            'success'   => true,
            'message'   => 'Successfuly add new product'
        ])->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ModelProduct  $modelProduct
     * @return \Illuminate\Http\Response
     */
    public function show(ModelProduct $modelProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ModelProduct  $modelProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(ModelProduct $modelProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ModelProduct  $modelProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(),[
            'product'   => "required|max:100"
        ],[
            'product.required' => "Product is required"
        ]);

        if($validate->fails()){
            return response()->json([
                'success'   => false,
                'message'   => $validate->errors()->first()
            ])->setStatusCode(200);
        }

        $product = ModelProduct::find($id);
        $product->product = $request->product;

        $product->save();
        return response()->json([
            'success'   => true,
            'message'   => 'Successfuly update a product'
        ])->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ModelProduct  $modelProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = ModelProduct::find($id);
        $product->delete();
        return response()->json([
            'success'   => true,
            'message'   => 'Successfuly delete a product'
        ])->setStatusCode(200);
    }
}
