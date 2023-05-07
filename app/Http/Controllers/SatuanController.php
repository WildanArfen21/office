<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('satuan.index');
    }

    public function read(){
        $satuan = Satuan::all();
        return view('merk.read')->with([
            'data' => $satuan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $max = Satuan::max('kode');
        $kode = substr($max,3);
        $kode++;
        $huruf= "STN";
        $maxkode = $huruf.sprintf("%03s",$kode);

        return view('satuan.create',compact('maxkode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required',
            'nama' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
            ]);
        }else{

            $satuan = new Satuan;
            $satuan->kode = $request->input('kode');
            $satuan->nama = $request->input('nama');
            $satuan->save();
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
        $data = Satuan::find($uuid);
        return view('satuan.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required',
            'nama' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
            ]);
        }else{
            $satuan = Satuan::find($uuid);
            if($satuan){
                $satuan->kode = $request->input('kode');
                $satuan->nama = $request->input('nama');
                $satuan->update();
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
        Satuan::destroy($uuid);
        return response()->json([
            'status' => 200,
        ]);
    }
}
