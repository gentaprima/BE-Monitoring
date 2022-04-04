<?php

namespace App\Http\Controllers;

use App\Models\ModelCategoryProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ModelCategoryProduct::all();
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
            'category'  => 'required'
        ],[
            'category.required' => "Category Product is required"
        ]);
        if($validate->fails()){
            return response()->json([
                'status'    => false,
                'message'   => $validate->errors()->first()
            ])->setStatusCode(200);
        }

        $categoryProduct = ModelCategoryProduct::create([
            'category'  => $request->category
        ]);
        $categoryProduct->save();
        return response()->json([
            'status'    => false,
            'message'   => 'Successfully inserting category product.'
        ])->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ModelCategoryProduct  $modelCategoryProduct
     * @return \Illuminate\Http\Response
     */
    public function show(ModelCategoryProduct $modelCategoryProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ModelCategoryProduct  $modelCategoryProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(ModelCategoryProduct $modelCategoryProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ModelCategoryProduct  $modelCategoryProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(),[
            'category'  => 'required'
        ],[
            'category.required' => "Category Product is required"
        ]);
        if($validate->fails()){
            return response()->json([
                'status'    => false,
                'message'   => $validate->errors()->first()
            ])->setStatusCode(200);
        }

        $categoryProduct = ModelCategoryProduct::find($id);
        $categoryProduct->category = $request->category;
        $categoryProduct->save();
        return response()->json([
            'status'    => true,
            'message'   => 'Successfully updating category product.'
        ])->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ModelCategoryProduct  $modelCategoryProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoryProduct = ModelCategoryProduct::find($id);
        $categoryProduct->delete();
        return response()->json([
            'status'    => true,
            'message'   => 'Successfully deleting category product.'
        ])->setStatusCode(200);
    }
}
