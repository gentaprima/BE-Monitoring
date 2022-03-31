<?php

namespace App\Http\Controllers;

use App\Models\ModelJabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ModelJabatan::all();
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
            'jabatan'   => 'required|max:100'
        ],
        [
            'jabatan.required' => 'Jabatan is required'
        ]);

        if($validate->fails()){
            return response()->json([
                'success'   => false,
                'message'   => $validate->errors()->first()
                ])->setStatusCode(200);
        }
        $words = explode(" ", $request->jabatan);
        $acronym = "";

        foreach ($words as $w) {
            $acronym .= $w[0];
        }

        $jabatan = ModelJabatan::create([
            'jabatan' => $request->jabatan,
            'singkatan' => $acronym
        ]);
        $jabatan->save();
        return response()->json([
            'success'   => true,
            'message'   => "Successfully add new Position."
        ])->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ModelJabatan  $modelJabatan
     * @return \Illuminate\Http\Response
     */
    public function show(ModelJabatan $modelJabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ModelJabatan  $modelJabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(ModelJabatan $modelJabatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ModelJabatan  $modelJabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(),[
            'jabatan'   => 'required|max:100'
        ],
        [
            'jabatan.required' => 'Jabatan is required'
        ]);

        if($validate->fails()){
            return response()->json([
                'success'   => false,
                'message'   => $validate->errors()->first()
                ])->setStatusCode(200);
        }
        $words = explode(" ", $request->jabatan);
        $acronym = "";

        foreach ($words as $w) {
            $acronym .= $w[0];
        }
        $jabatan = ModelJabatan::find($id);
        $jabatan->jabatan = $request->jabatan;
        $jabatan->singkatan = $acronym;
        $jabatan->save();
        return response()->json([
            'success'   => true,
            'message'   => "Successfully update a Position."
        ])->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ModelJabatan  $modelJabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jabatan = ModelJabatan::find($id);
        $jabatan->delete();
        return response()->json([
            'success'   => true,
            'message'   => "Successfully delete a Position."
        ])->setStatusCode(200);
    }
}
