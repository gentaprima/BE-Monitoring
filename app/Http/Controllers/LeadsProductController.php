<?php

namespace App\Http\Controllers;

use App\Models\ModelLeads;
use App\Models\ModelLeadsProduct;
use App\Models\ModelPoin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LeadsProductController extends Controller
{
    
    public function index(Request $request)
    {
        $data = DB::table("tbl_leads_product")
                    ->leftJoin('tbl_leads','tbl_leads_product.id_leads','=','tbl_leads.id')
                    ->leftJoin('tbl_program','tbl_leads_product.id_program','=','tbl_program.id')
                    ->leftJoin('tbl_product','tbl_program.id_product','=','tbl_product.id')
                    ->leftJoin('tbl_customer','tbl_leads.id_customer','=','tbl_customer.id')
                    ->leftJoin('tbl_karyawan','tbl_leads.id_karyawan','=','tbl_karyawan.id')
                    ->select('tbl_leads_product.*','tbl_program.program','tbl_program.id_product','tbl_product.product','tbl_product.icon','tbl_product.persyaratan')
                    ->where('tbl_leads_product.id_leads','=',$request->id_leads)
                    ->where('tbl_leads_product.status','=',$request->status)
                    ->paginate($request->limit ? $request->limit : 5);

        return response()->json([
            'success'   => true,
            'data'      => $data->items()
        ]);

    }

   
    public function store(Request $request,$id)
    {
        $validate = Validator::make($request->all(),[
            'id_program' => 'required'
        ],
        [
            'id_program.required' => "Program is required"
        ]);

        if($validate->fails()){
            return response()->json([
                'success'   => false,
                'message'   => $validate->errors()->first()
            ]);
        }

        $leadsProduct = ModelLeadsProduct::create([
            'id_leads' => $id,
            'id_program'    => $request->id_program,
            'status'    => 0
        ]);

        $leadsProduct->save();
        return response()->json([
            'success'   => true,
            'message'   => "Successfully added a new Leads"
        ]);
    }
   
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(),[
            'status'    => 'required'
        ],[
            'status.required' => "Status is required"
        ]);
        if($validate->fails()){
            return response()->json([
                'success'   => false,
                'message'   => $validate->errors()->first()
            ]);
        }

        $leadsProduct = ModelLeadsProduct::find($id);
        $idLeads = $leadsProduct['id_leads'];

        $leads = ModelLeads::find($idLeads);
        $leads->is_contact = 1;
        $leads->save();


        if($request->status == 1){
            $poin = ModelPoin::create([
                'poin'  => 5,
                'insentif'  => 6000,
                'id_karyawan'   => $leads['id_karyawan']
            ]);

            $poin->save();
        }else if($request->status == 2 || $request->status == 3){
            if($request->alasan == ""){
                return response()->json([
                    'success'   => false,
                    'message'   => "Alasan is required"
                ]);
            }
        }

        $leadsProduct->status = $request->status;
        $leadsProduct->alasan = $request->alasan;
        $leadsProduct->save();

        return response()->json([
            'success'   => true,
            'message'   => "Successfully update a response"
        ]);

        


    }

  
    public function destroy($id)
    {
        //
    }
}
