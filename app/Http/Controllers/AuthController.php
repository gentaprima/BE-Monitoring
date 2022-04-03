<?php

namespace App\Http\Controllers;

use App\Models\ModelKaryawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        
    }

    public function login(Request $request){
        $validate   =   Validator::make($request->all(), [
            'nip'     =>  'required|max:100',
            'password'  =>  'required|max:100',
        ],
        [
            'nip.required'            =>  'Nip is required',
            'password.required'         =>  'Password  is required',
            'nip.max'                 =>  'Email max 100 characters',
            'passowrd.max'              =>  'Password max 100 characters',
        ]);

        if($validate->fails()) {
            return response()->json([
            'success'   => false,
            'message'   => $validate->errors()->first()
            ])->setStatusCode(400);
        }

        // $checkData = ModelKaryawan::where('nip',$request->nip)->first();
        $checkData = DB::table('tbl_karyawan')
                        ->leftJoin('tbl_jabatan','tbl_karyawan.id_jabatan','=','tbl_jabatan.id')
                        ->select('tbl_karyawan.*','tbl_jabatan.jabatan')
                        ->where('nip','=',$request->nip)
                        ->first();
        if($checkData == null){
            return response()->json([
                'success'   => false,
                'message'   => 'Nip not found !'
                ])->setStatusCode(400);
        }
        if(!Hash::check($request->password, $checkData->password)){
            return response()->json([
                'success'   => false,
                'message'   => 'Pleace Checkk your nip and password'
                ])->setStatusCode(400);
        }

        return response()->json([
            'success'   => true,
            'message'   => 'success',
            'data'      => $checkData
        ])->setStatusCode(200);
    }
}
