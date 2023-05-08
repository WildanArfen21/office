<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Merk;
use App\Models\Satuan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('barang.index');
    }

    public function read(){
        $barang = Barang::all();
        return view('barang.read')->with([
            'data' => $barang,
            'merk' => 'merk',
            'satuan' => 'satuan',
            'kategori' => 'kategori',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $max = Barang::max('kode');
        $kode = substr($max,3);
        $kode++;
        $huruf= "BRG";
        $maxkode = $huruf.sprintf("%03s",$kode);

        $merk = Merk::all();
        $satuan = Satuan::all();
        $kategori = Kategori::all();

        return view('barang.create',compact('maxkode','merk','satuan','kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required',
            'nama' => 'required',
            'kategori' => 'required',
            'merk' => 'required',
            'satuan' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
            ]);
        }else{

            $barang = new Barang;
            $barang->kode = $request->input('kode');
            $barang->nama = $request->input('nama');
            $barang->uuid_kategori = $request->input('kategori');
            $barang->uuid_merk = $request->input('merk');
            $barang->uuid_satuan = $request->input('satuan');
            $barang->save();
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
        $data = Barang::find($uuid);
        $merk = Merk::all();
        $satuan = Satuan::all();
        $kategori = Kategori::all();
        return view('barang.edit', compact('data','merk','satuan','kategori'));
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
            $barang = Barang::find($uuid);
            if($barang){
                $barang->kode = $request->input('kode');
                $barang->nama = $request->input('nama');
                $barang->uuid_kategori = $request->input('kategori');
                $barang->uuid_merk = $request->input('merk');
                $barang->uuid_satuan = $request->input('satuan');
                $barang->update();
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
        Barang::destroy($uuid);
        return response()->json([
            'status' => 200,
        ]);
    }
}
