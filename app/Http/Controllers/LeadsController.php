<?php

namespace App\Http\Controllers;

use App\Models\ModelCustomer;
use App\Models\ModelLeads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LeadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id)
    {
        $data = DB::table('tbl_leads')
                    ->leftJoin('tbl_customer','tbl_leads.id_customer','=','tbl_customer.id')
                    ->leftJoin('tbl_karyawan','tbl_leads.id_karyawan','=','tbl_karyawan.id')
                    ->select('tbl_leads.*','tbl_customer.nik','tbl_customer.nama_customer','tbl_customer.email','tbl_customer.tgl_lahir','tbl_customer.jenis_kelamin','tbl_customer.no_rek')
                    ->where('tbl_leads.id_karyawan','=',$id)
                    ->paginate($request->limit ? $request->limit : 5);

        return response()->json([
            'success'   => true,
            'data'      => $data->items()
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
    public function store(Request $request,$id)
    {
        $validate = Validator::make($request->all(),[
            'nik'                   => 'required',
            'nama_customer'         => 'required',
            'email'                 => 'required|email',
            'no_rek'                => 'required',
            'jenis_kelamin'         => 'required',
            'tgl_lahir'             => 'required',  
            'telepon'               => 'required',
        ],[
            'nik.required'                  => "Nik is required",
            'nama_customer.required'        => "Customers Name is required",
            'email.required'                => "Email is required",
            'no_rek.required'               => "Account Number is required",
            'jenis_kelamin.required'        => "Gender is required",
            'tgl_lahir.required'            => "Date of Birth is required",
            'tgl_lahir.date'                => 'Date of Birth is not a valid date. (YYYY-MM-DD)',
            'telepon.required'              => "Phone Number is required"
        ]);

        if($validate->fails()){
            return response()->json([
                'success'   => false,
                'mesasge'   => $validate->errors()->first()
            ]);
        }



        $checkCustomer = ModelCustomer::where('nik','=',$request->nik)
                                    ->orWhere('email','=',$request->email)
                                    ->first();

        if($checkCustomer != null){
            return response()->json([
                'success'       => false,
                'message'       => "Nik or Email is already exist"
            ]);
        }

        
        $customer = ModelCustomer::create([
            'nik'                 => $request->nik,
            'nama_customer'       => $request->nama_customer,
            'email'               => $request->email,
            'no_rek'              => $request->no_rek,
            'jenis_kelamin'       => $request->jenis_kelamin,
            'tgl_lahir'           => $request->tgl_lahir,
            'telepon'             => $request->telepon,
            'tgl_pendaftaran'     => date('Y-m-d')
        ]);

        $customer->save();

        $getCustomer = ModelCustomer::where('nik','=',$request->nik)->first();
        
        $leads = ModelLeads::create([
            'id_customer'   => $getCustomer['id'],
            'id_karyawan'   => $id
        ]);

        $leads->save();

        return response()->json([
            'success'   => true,
            'message'   => "successfully create a new leads"
        ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
