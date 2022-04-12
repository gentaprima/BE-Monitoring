<?php

namespace App\Http\Controllers;

use App\Models\ModelLeads;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $allLeads = ModelLeads::all();
        $leadsContact = ModelLeads::all()->where('is_contact','=',1);
        $leadsNotContact = ModelLeads::all()->where('is_contact','=',0);

        $data = [
            [
                ''
            ]
        ];
        return response()->json([
            'success' => true,
            'data'  => $data
        ])

    }
}
