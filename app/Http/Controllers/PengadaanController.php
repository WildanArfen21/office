<?php

namespace App\Http\Controllers;

use App\Models\Pengadaan;
use App\Models\Jenis_Pengadaan;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengadaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pengadaan.index');
    }

    public function read(){
        $pengadaan = Pengadaan::all();
        return view('pengadaan.read')->with([
            'data' => $pengadaan,
            'jenis' => 'jenis',
            'supplier' => 'supplier',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $max = Pengadaan::max('nomor_pengadaan');
        $kode = substr($max,3);
        $kode++;
        $huruf= "NP";
        $nopeng = $huruf.sprintf("%05s",$kode);

        $jenis = Jenis_Pengadaan::all();
        $supplier = Supplier::all();
        return view('pengadaan.create', compact('jenis','supplier','nopeng'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'jenis' => 'required',
            'no' => 'required',
            'tgl' => 'required',
            'keterangan' => 'nullable',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
            ]);
        }else{

            $pengadaan = new Pengadaan();
            $pengadaan->uuid_supplier = $request->input('nama');
            $pengadaan->uuid_jenis_pengadaan = $request->input('jenis');
            $pengadaan->nomor_pengadaan = $request->input('no');
            $pengadaan->tanggal_pengadaan = $request->input('tgl');
            $pengadaan->keterangan = $request->input('keterangan');
            $pengadaan->save();
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
        $jenis = Jenis_Pengadaan::all();
        $supplier = Supplier::all();
        $data = Pengadaan::find($uuid);
        return view('pengadaan.edit', compact('data','jenis','supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'jenis' => 'required',
            'no' => 'required',
            'tgl' => 'required',
            'keterangan' => 'nullable',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
            ]);
        }else{
            $pengadaan = Pengadaan::find($uuid);
            if($pengadaan){
                $pengadaan->uuid_supplier = $request->input('nama');
                $pengadaan->uuid_jenis_pengadaan = $request->input('jenis');
                $pengadaan->nomor_pengadaan = $request->input('no');
                $pengadaan->tanggal_pengadaan = $request->input('tgl');
                $pengadaan->keterangan = $request->input('keterangan');
                $pengadaan->update();
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
        Pengadaan::destroy($uuid);
        return response()->json([
            'status' => 200,
        ]);
    }
}
