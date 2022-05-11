<?php

namespace App\Http\Controllers;

use App\Models\ModelReason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReasonController extends Controller
{
    public function index()
    {
        $data = ModelReason::all();
        return response()->json([
            'success'   => true,
            'data'   => $data
        ])->setStatusCode(200);    
    }
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

    public function destroy($id)
    {
        $reason = ModelReason::find($id);
        $reason->delete();
        return response()->json([
            'success'   => true,
            'message'   => 'Successfully deleting reason.'
        ])->setStatusCode(200);  
    }

    public function getByType($id){
        $data = DB::table('tbl_alasan')
                    ->where('type','=',$id)
                    ->get();
        return response()->json([
            'success'   => true,
            'data'      => $data
        ])->setStatusCode(200);
    }
}
