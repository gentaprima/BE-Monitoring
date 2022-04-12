<?php

namespace App\Http\Controllers;

use App\Models\ModelProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('tbl_program')
                    ->leftJoin('tbl_product','tbl_program.id_product','=','tbl_product.id')
                    ->leftJoin('tbl_category_product','tbl_product.id_category_product','=','tbl_category_product.id')
                    ->select('tbl_program.*','tbl_product.product','tbl_category_product.category')
                    ->get();
        return response()->json([
            'success' => true,
            'data'  => $data    
        ]);

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
            'program'   => 'required',
            'id_product'   => 'required'
        ],[
            'program.required'  => 'Program is required',
            'id_product.required'  => 'Product is required'
        ]);

        if($validate->fails()){
            return response()->json([
                'success'   => false,
                'message'   => $validate->errors()->first()
            ]);
        }

        $program = ModelProgram::create([
            'program'   => $request->program,
            'id_product'    => $request->id_product
        ]);
        $program->save();
        return response()->json([
            'success'   => true,
            'message'   => 'Successfully inserting a program'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ModelProgram  $modelProgram
     * @return \Illuminate\Http\Response
     */
    public function show(ModelProgram $modelProgram)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ModelProgram  $modelProgram
     * @return \Illuminate\Http\Response
     */
    public function edit(ModelProgram $modelProgram)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ModelProgram  $modelProgram
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(),[
            'program'   => 'required',
            'id_product'   => 'required'
        ],[
            'program.required'  => 'Program is required',
            'id_product.required'  => 'Product is required'
        ]);

        if($validate->fails()){
            return response()->json([
                'success'   => false,
                'message'   => $validate->errors()->first()
            ]);
        }

        $program = ModelProgram::find($id);
        $program->program = $request->program;
        $program->id_product = $request->id_product;
        $program->save();
        return response()->json([
            'success'   => true,
            'message'   => 'Successfully updating a program'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ModelProgram  $modelProgram
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $program = ModelProgram::find($id);
        $program->delete();
        return response()->json([
            'success'   => true,
            'message'   => 'Successfully deletinggetByProduct a program'
        ]);
    }

    public function getByProduct($id){
        $data = DB::table('tbl_program')
                    ->leftJoin('tbl_product','tbl_program.id_product','=','tbl_product.id')
                    ->leftJoin('tbl_category_product','tbl_product.id_category_product','=','tbl_category_product.id')
                    ->select('tbl_program.*','tbl_product.product','tbl_category_product.category')
                    ->where('tbl_program.id_product','=',$id)
                    ->get();
        return response()->json([
            'success' => true,
            'data'  => $data    
        ]);
    }
}
