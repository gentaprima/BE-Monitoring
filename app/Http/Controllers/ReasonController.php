<?php

namespace App\Http\Controllers;

use App\Models\ModelReason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ModelReason::all();
        return response()->json([
            'success'   => true,
            'data'   => $data
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
            'alasan'    => 'required',
            'type'      => 'required'
        ],[
            'alasan.required' => "Reason is required",
            'type.required' => "Type of Reason is required"
        ]);

        if($validate->fails()){
            return response()->json([
                'success'   => true,
                'message'   => $validate->errors()->first()
            ])->setStatusCode(200);    
        }

        $reason = ModelReason::create([
            'alasan'    => $request->alasan,
            'type'      => $request->type
        ]);
        $reason->save();
        return response()->json([
            'success'   => true,
            'message'   => 'Successfully inserting reason.'
        ])->setStatusCode(200);   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ModelReason  $modelReason
     * @return \Illuminate\Http\Response
     */
    public function show(ModelReason $modelReason)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ModelReason  $modelReason
     * @return \Illuminate\Http\Response
     */
    public function edit(ModelReason $modelReason)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ModelReason  $modelReason
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(),[
            'alasan'    => 'required',
            'type'      => 'required'
        ],[
            'alasan.required' => "Reason is required",
            'type.required' => "Type of Reason is required"
        ]);

        if($validate->fails()){
            return response()->json([
                'success'   => true,
                'message'   => $validate->errors()->first()
            ])->setStatusCode(200);    
        }

        $reason = ModelReason::find($id);
        $reason->alasan = $request->alasan;
        $reason->type = $request->type;
        $reason->save();
        return response()->json([
            'success'   => true,
            'message'   => 'Successfully updating reason.'
        ])->setStatusCode(200);   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ModelReason  $modelReason
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reason = ModelReason::find($id);
        $reason->delete();
        return response()->json([
            'success'   => true,
            'message'   => 'Successfully deleting reason.'
        ])->setStatusCode(200);  
    }
}
