<?php

namespace App\Http\Controllers;

use App\Models\Pengadaan_Detail;
use App\Models\Pengadaan;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengadaanDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pengadaan-detail.index');
    }

    public function read(){
        $pengtail = Pengadaan_Detail::all();
        return view('pengadaan-detail.read')->with([
            'data' => $pengtail,
            'barang' => 'barang',
            'pengadaan' => 'pengadaan',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barang = Barang::all();
        $pengadaan = Pengadaan::all();

        return view('pengadaan-detail.create',compact('barang','pengadaan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'no' => 'required',
            'harga' => 'required',
            'jumlah' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
            ]);
        }else{

            $pengtail = new Pengadaan_Detail();
            $pengtail->uuid_barang = $request->input('nama');
            $pengtail->uuid_pengadaan = $request->input('no');
            $pengtail->harga = $request->input('harga');
            $pengtail->jumlah = $request->input('jumlah');
            $pengtail->total = $request->input('harga') * $request->input('jumlah') ;
            $pengtail->save();
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
        $barang = Barang::all();
        $pengadaan = Pengadaan::all();
        $data = Pengadaan_Detail::find($uuid);
        return view('pengadaan-detail.edit', compact('data','barang','pengadaan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'no' => 'required',
            'harga' => 'required',
            'jumlah' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
            ]);
        }else{
            $pengtail = Pengadaan_Detail::find($uuid);
            if($pengtail){
                $pengtail->uuid_barang = $request->input('nama');
                $pengtail->uuid_pengadaan = $request->input('no');
                $pengtail->harga = $request->input('harga');
                $pengtail->jumlah = $request->input('jumlah');
                $pengtail->total = $request->input('harga') * $request->input('jumlah') ;
                $pengtail->update();
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
        Pengadaan_Detail::destroy($uuid);
        return response()->json([
            'status' => 200,
        ]);
    }
}
