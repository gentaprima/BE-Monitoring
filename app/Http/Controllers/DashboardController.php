<?php

namespace App\Http\Controllers;

use App\Models\ModelLeads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index($id){

        // Contact Customer
        $allLeads = ModelLeads::all()->where('id_karyawan','=',$id);
        $leadsContact = ModelLeads::all()->where('is_contact','=',1)->where('id_karyawan','=',$id);
        $leadsNotContact = ModelLeads::all()->where('is_contact','=',0)->where('id_karyawan','=',$id);

        $alreadyContactPercent = 0;
        $notContactPercent = 0;

        if(count($allLeads) > 0){
            $alreadyContactPercent = (count($leadsContact)/count($allLeads)) * 100;
            $notContactPercent = (count($leadsNotContact)/count($allLeads)) * 100;
        }


        // Poin
        $poin = DB::table('tbl_poin')
                    ->where('id_karyawan','=',$id)
                    ->sum('poin');

        $insentif = DB::table('tbl_poin')
                        ->where('id_karyawan','=',$id)
                        ->sum('insentif');

        $allLeadsProduct = DB::table('tbl_leads_product')
                                ->leftJoin('tbl_leads','tbl_leads_product.id_leads','=','tbl_leads.id')
                                ->where('tbl_leads.id_karyawan','=',$id)
                                ->get();
        $followUpPercent = 0;
        $interestedPercent = 0;
        $refusePercent = 0;


        $followUp =  DB::table('tbl_leads_product')
                        ->leftJoin('tbl_leads','tbl_leads_product.id_leads','=','tbl_leads.id')
                        ->where('tbl_leads.id_karyawan','=',$id)
                        ->where('tbl_leads_product.status','=',2)
                        ->get();

        $interested =  DB::table('tbl_leads_product')
                        ->leftJoin('tbl_leads','tbl_leads_product.id_leads','=','tbl_leads.id')
                        ->where('tbl_leads.id_karyawan','=',$id)
                        ->where('tbl_leads_product.status','=',1)
                        ->get();

        $refuse =  DB::table('tbl_leads_product')
                        ->leftJoin('tbl_leads','tbl_leads_product.id_leads','=','tbl_leads.id')
                        ->where('tbl_leads.id_karyawan','=',$id)
                        ->where('tbl_leads_product.status','=',3)
                        ->get();

        // dd(0/0);
        
        if(count($allLeadsProduct) > 0){
            $followUpPercent = (count($followUp)/count($allLeadsProduct)) * 100;
            $interestedPercent = (count($interested)/count($allLeadsProduct)) * 100;
            $refusePercent = (count($refuse)/count($allLeadsProduct)) * 100;
        }
                

        $data = [
          "already_contact" => count($leadsContact),
          "already_contact_percent" => $alreadyContactPercent == 100 ? $alreadyContactPercent : substr($alreadyContactPercent,0,2),
          "not_contact" => count($leadsNotContact),
          "not_contact_percent" => $notContactPercent == 100 ? $notContactPercent : substr($notContactPercent,0,2),
          "point_of_sales" => $poin,
          "insentif"       => $insentif,
          "follow_up"      => count($followUp),
          "follow_up_percent" => $followUpPercent == 100 ? $followUpPercent : substr($followUpPercent,0,2),
          "interested"      => count($interested),
          "interested_percent" => $interestedPercent == 100 ? $interestedPercent : substr($interestedPercent,0,2),
          "refuse"      => count($refuse),
          "refuse_percent" => $refusePercent == 100 ? $refusePercent : substr($refusePercent,0,2),
        ];

        return response()->json([
            'success' => true,
            'data'  => $data
        ]);

    }
}
