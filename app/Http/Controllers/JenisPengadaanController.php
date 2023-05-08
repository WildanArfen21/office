<?php

namespace App\Http\Controllers;

use App\Models\Jenis_Pengadaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JenisPengadaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('jenis-pengadaan.index');
    }
    
    public function read(){
        $jenis = Jenis_Pengadaan::all();
        return view('jenis-pengadaan.read')->with([
            'data' => $jenis
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jenis-pengadaan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
            ]);
        }else{

            $jenis = new Jenis_Pengadaan;
            $jenis->nama = $request->input('nama');
            $jenis->save();
            return response()->json([
                'status' => 200,
            ]);
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        $data = Jenis_Pengadaan::find($uuid);
        return view('jenis-pengadaan.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
            ]);
        }else{
            $jenis = Jenis_Pengadaan::find($uuid);
            if($jenis){
                $jenis->nama = $request->input('nama');
                $jenis->update();
                return response()->json([
                'status' => 200,
                ]);
            }else{
                return response()->json([
                    'status' => 404,
                    ]);
            }
            
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        Jenis_Pengadaan::destroy($uuid);
        return response()->json([
            'status' => 200,
        ]);
    }
}
