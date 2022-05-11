<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReminderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = DB::table("tbl_reminder")
                ->leftJoin('tbl_leads_product','tbl_reminder.id_leads_product','=','tbl_leads_product.id')
                ->leftJoin('tbl_leads','tbl_leads_product.id_leads','=','tbl_leads.id')
                ->leftJoin('tbl_program','tbl_leads_product.id_program','=','tbl_program.id')
                ->leftJoin('tbl_product','tbl_program.id_product','=','tbl_product.id')
                ->leftJoin('tbl_customer','tbl_leads.id_customer','=','tbl_customer.id')
                ->leftJoin('tbl_karyawan','tbl_leads.id_karyawan','=','tbl_karyawan.id')
                ->select('tbl_reminder.*','tbl_leads_product.id_program','tbl_leads_product.id_leads','tbl_leads_product.status','tbl_leads_product.alasan','tbl_program.program','tbl_program.id_product','tbl_product.product','tbl_product.icon','tbl_product.persyaratan')
                ->where('tbl_leads.id_karyawan','=',$request->id_karyawan)
                ->where('tbl_reminder.tgl','=',$request->date)
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
    public function store(Request $request)
    {
        //
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
