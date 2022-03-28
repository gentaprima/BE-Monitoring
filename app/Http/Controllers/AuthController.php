<?php

namespace App\Http\Controllers;

use App\Models\ModelKaryawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        
    }

    public function login(Request $request){
        $validate   =   Validator::make($request->all(), [
            'email'     =>  'required|max:100',
            'password'  =>  'required|max:100',
        ],
        [
            'email.required'            =>  'Email is required',
            'password.required'         =>  'Password  is required',
            'email.max'                 =>  'Email max 100 characters',
            'passowrd.max'              =>  'Password max 100 characters',
        ]);

        if($validate->fails()) {
            return response()->json([
            'success'   => false,
            'message'   => $validate->errors()->first()
            ])->setStatusCode(400);
        }

        $checkData = ModelKaryawan::where('email',$request->email)->first();
        if($checkData == null){
            return response()->json([
                'success'   => false,
                'message'   => 'Email not found !'
                ])->setStatusCode(400);
        }

        if($checkData['password'] != $request->password){
            return response()->json([
                'success'   => false,
                'message'   => 'Pleace Checkk your email and password'
                ])->setStatusCode(400);
        }

        return response()->json([
            'success'   => true,
            'message'   => 'success',
            'data'      => $checkData
            ])->setStatusCode(200);
    }
}
