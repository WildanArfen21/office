<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('peminjaman.index');
    }

    public function read(){
        $peminjaman = Peminjaman::all();
        return view('peminjaman.read')->with([
            'data' => $peminjaman,
            'karyawan' => 'karyawan'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        $karyawan = Karyawan::all();

        return view('peminjaman.create',compact('karyawan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'tgl_peminjaman' => 'required',
            'tgl_akan_kembali' => 'required',
            'status' => 'required',
            'keterangan' => 'nullable',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
            ]);
        }else{

            $peminjaman = new Peminjaman;
            $peminjaman->uuid_karyawan = $request->input('nama');
            $peminjaman->tgl_peminjaman = $request->input('tgl_peminjaman');
            $peminjaman->tgl_akan_kembali = $request->input('tgl_akan_kembali');
            $peminjaman->status = $request->input('status');
            $peminjaman->keterangan = $request->input('keterangan');
            $peminjaman->save();
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
        $karyawan = Karyawan::all();
        $data = Peminjaman::find($uuid);
        return view('peminjaman.edit', compact('data','karyawan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'tgl_peminjaman' => 'required',
            'tgl_akan_kembali' => 'required',
            'status' => 'required',
            'keterangan' => 'nullable',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
            ]);
        }else{
            $peminjaman = Peminjaman::find($uuid);
            if($peminjaman){
                $peminjaman->uuid_karyawan = $request->input('nama');
            $peminjaman->tgl_peminjaman = $request->input('tgl_peminjaman');
            $peminjaman->tgl_akan_kembali = $request->input('tgl_akan_kembali');
            $peminjaman->status = $request->input('status');
            $peminjaman->keterangan = $request->input('keterangan');
            $peminjaman->update();
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
        Peminjaman::destroy($uuid);
        return response()->json([
            'status' => 200,
        ]);
    }
}
