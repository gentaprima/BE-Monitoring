<?php

namespace App\Http\Controllers;

use App\Models\ModelKaryawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ModelKaryawan::all();
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
            'nik'                       =>  'required|max:16',
            'nama_karyawan'             =>  'required|max:100',
            'email'                     =>  'required|max:100|email',
            'tgl_lahir'                 =>  'required|date',
            'jabatan'                   =>  'required|max:100',
        ],[
            'nik.required'              =>  'Nik is required',
            'nik.max'                   =>  'Nik max is 16 characters',
            'email.required'            =>  'Email is required',
            'email.max'                 =>  'Email max 100 characters',
            'nama_karyawan.required'    =>  'Employee Name is required',
            'nama_karyawan.max'         =>  'Employee Name max 100 characters',
            'tgl_lahir.required'        =>  'Date of Birth is required',
            'tgl_lahir.date'            =>  'Date of Birth is not a valid date. (YYYY-MM-DD)',
            'jabatan.required'          =>  'Position of Birth is required',
        ]);

        if($validate->fails()) {
            return response()->json([
            'success'   => false,
            'message'   => $validate->errors()->first()
            ])->setStatusCode(200);
        }

        $checkEmail = ModelKaryawan::where('email',$request->email)->first();
        if($checkEmail != null){
            return response()->json([
            'success'   => false,
            'message'   => "Email is already use, Please change your email!"
            ])->setStatusCode(200);
        }

        $checkData = ModelKaryawan::orderByDesc('id')->limit(1)->first();
        $nip = "10000";
        if($checkData != null){
            $nip = $checkData['nip'] + 1;
        }

        $karyawan = ModelKaryawan::create([
            'nip'               => $nip,
            'nik'               => $request->nik,
            'nama_karyawan'     => $request->nama_karyawan,
            'email'             => $request->email,
            'password'          => md5($request->nip),
            'tgl_lahir'         => $request->tgl_lahir,
            'jabatan'           => $request->jabatan,
            'role'              => 0
        ]);

        $karyawan->save();
        return response()->json([
            'success'   => true,
            'message'   => "Successfully add new Employee."
        ])->setStatusCode(200);
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ModelKaryawan  $modelKaryawan
     * @return \Illuminate\Http\Response
     */
    public function show(ModelKaryawan $modelKaryawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ModelKaryawan  $modelKaryawan
     * @return \Illuminate\Http\Response
     */
    public function edit(ModelKaryawan $modelKaryawan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ModelKaryawan  $modelKaryawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {   
        $validate = Validator::make($request->all(),[
            'nama_karyawan'             =>  'required|max:100',
            'email'                     =>  'required|max:100|email',
            'password'                     =>  'required|max:100',
            'tgl_lahir'                 =>  'required|date',
        ],[
            'email.required'            =>  'Email is required',
            'email.max'                 =>  'Email max 100 characters',
            'password.required'         =>  'Password is required',
            'password.max'              =>  'Password max 100 characters',
            'nama_karyawan.required'    =>  'Employee Name is required',
            'nama_karyawan.max'         =>  'Employee Name max 100 characters',
            'tgl_lahir.required'        =>  'Date of Birth is required',
            'tgl_lahir.date'            =>  'Date of Birth is not a valid date. (YYYY-MM-DD)',
        ]);

        if($validate->fails()) {
            return response()->json([
            'success'   => false,
            'message'   => $validate->errors()->first()
            ])->setStatusCode(200);
        }
         
       
        $karyawan = ModelKaryawan::find($id);
        $karyawan->nama_karyawan = $request->nama_karyawan;
        $karyawan->email = $request->email;
        $karyawan->tgl_lahir  = $request->tgl_lahir;
        $karyawan->password  = md5($request->password);

        $karyawan->save();
        return response()->json([
            'success'   => true,
            'message'   => "Successfully edit data."
        ])->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ModelKaryawan  $modelKaryawan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $karyawan = ModelKaryawan::find($id);
        $karyawan->delete();
        return response()->json([
            'success'   => true,
            'message'   => "Successfully delete data."
        ])->setStatusCode(200);
    }   
}
