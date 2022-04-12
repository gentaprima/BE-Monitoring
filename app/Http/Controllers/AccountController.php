<?php

namespace App\Http\Controllers;

use App\Models\ModelKaryawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function updateProfile(Request $request,$id){
        $validate = Validator::make($request->all(),[
            'nik'            => "required|max:16",
            'nama_karyawan'  => 'required',
            'email'          => 'required|email',
            'tgl_lahir'      => 'required|date',
            
        ],
        [
            'nik.required'              => "Nik is required",
            'nama_karyawan.required'    => "Employee Name is required",
            'email.required'            => "Email is required",
            'tgl_lahir.required'        =>  'Date of Birth is required',
            'tgl_lahir.date'            =>  'Date of Birth is not a valid date. (YYYY-MM-DD)',
        ]);

        if($validate->fails()){
            return response()->json([
                'success'   => false,
                'message'   => $validate->errors()->first()
            ]);
        }

        $imageProfile = $request->file('image');
        $account = ModelKaryawan::find($id);
        if($imageProfile == null){
            $filename = $account['image'];
        }else{
            $filename = uniqid() . time() . "."  . explode("/", $imageProfile->getMimeType())[1];
            Storage::disk('uploads')->put('profile/'.$filename,File::get($imageProfile)); 
        }


        $account->nik = $request->nik;
        $account->nama_karyawan = $request->nama_karyawan;
        $account->email = $request->email;
        $account->tgl_lahir = $request->tgl_lahir;
        $account->image =  $filename;
        $account->save();

        return response()->json([
                'success'   => true,
                'message'   => 'Succesfully updating profile.'
        ]);
    }

    public function changePassword(Request $request,$id){
        $validate = Validator::make($request->all(),[
            'old_password'  => "required",
            'new_password'  => "required",
            'confirm_password'  => "required",
        ],[
            'old_password.required'         => 'Old Password is required',
            'new_password.required'         => 'New Password is required',
            'confirm_password.required'     => 'Confirm Password is required',
        ]);

        if($validate->fails()){
            return response()->json([
                'success'   => false,
                'message'   => $validate->errors()->first()
            ]);
        }

        $dataUsers = ModelKaryawan::find($id);
        if(!Hash::check($request->old_password, $dataUsers->password)){
            return response()->json([
                'success'   => false,
                'message'   => "sorry, your old password doesn't match"
            ]);
        }

        if($request->new_password != $request->confirm_password){
            return response()->json([
                'success'   => false,
                'message'   => "Sorry, your new password is not the same as the confirmation password"
            ]);
        }

        $dataUsers->password = Hash::make($request->new_password);
        $dataUsers->save();
        return response()->json([
            'success'   => true,
            'message'   => "Successfully updating your password"
        ]);
    }
}
