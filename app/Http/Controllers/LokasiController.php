<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\Departemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('lokasi.index');
    }

    public function read(){
        $lokasi = Lokasi::all();
        return view('lokasi.read')->with([
            'data' => $lokasi,
            'departemen' => 'departemen'
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $max = Lokasi::max('kode');
        $kode = substr($max,3);
        $kode++;
        $huruf= "LKS";
        $maxkode = $huruf.sprintf("%03s",$kode);
        $departemen = Departemen::all();

        return view('lokasi.create',compact('maxkode','departemen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required',
            'nama' => 'required',
            'departemen' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
            ]);
        }else{

            $lokasi = new Lokasi;
            $lokasi->kode = $request->input('kode');
            $lokasi->nama = $request->input('nama');
            $lokasi->uuid_departemen = $request->input('departemen');
            $lokasi->save();
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
        $data = Lokasi::find($uuid);
        $departemen = Departemen::all();
        return view('lokasi.edit', compact('data','departemen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required',
            'nama' => 'required',
            'departemen' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
            ]);
        }else{
            $lokasi = Lokasi::find($uuid);
            if($lokasi){
                $lokasi->kode = $request->input('kode');
                $lokasi->nama = $request->input('nama');
                $lokasi->uuid_departemen = $request->input('departemen');
                $lokasi->update();
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
        Lokasi::destroy($uuid);
        return response()->json([
            'status' => 200,
        ]);
    }
}
