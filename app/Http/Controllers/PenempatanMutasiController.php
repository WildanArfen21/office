<?php

namespace App\Http\Controllers;

use App\Models\Penempatan_Mutasi;
use App\Models\Lokasi;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenempatanMutasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('penempatan-mutasi.index');
    }

    public function read(){
        $penempatan_mutasi = Penempatan_Mutasi::all();
        return view('penempatan-mutasi.read')->with([
            'data' => $penempatan_mutasi,
            'lokasi' => 'lokasi',
            'karyawan' => 'karyawan',

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $max = Karyawan::max('kode');
        $kode = substr($max,3);
        $kode++;
        $huruf= "KRY";
        $maxkode = $huruf.sprintf("%03s",$kode);

        $user = User::all();

        return view('karyawan.create',compact('maxkode','user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required',
            'nama' => 'required',
            'user' => 'required',
            'gender' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'foto' => 'nullable',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
            ]);
        }else{

            $karyawan = new Karyawan;
            $karyawan->kode = $request->input('kode');
            $karyawan->nama = $request->input('nama');
            $karyawan->uuid_user = $request->input('user');
            $karyawan->jenis_kelamin = $request->input('gender');
            $karyawan->alamat = $request->input('alamat');
            $karyawan->no_telp = $request->input('no_telp');
            $karyawan->foto = $request->input('foto');
            $karyawan->save();
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
        $user = User::all();
        $data = Karyawan::find($uuid);
        return view('karyawan.edit', compact('data','user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required',
            'nama' => 'required',
            'user' => 'required',
            'gender' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'foto' => 'nullable',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
            ]);
        }else{
            $karyawan = Karyawan::find($uuid);
            if($karyawan){
                $karyawan->kode = $request->input('kode');
            $karyawan->nama = $request->input('nama');
            $karyawan->uuid_user = $request->input('user');
            $karyawan->jenis_kelamin = $request->input('gender');
            $karyawan->alamat = $request->input('alamat');
            $karyawan->no_telp = $request->input('no_telp');
            $karyawan->foto = $request->input('foto');
            $karyawan->update();
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
        Karyawan::destroy($uuid);
        return response()->json([
            'status' => 200,
        ]);
    }
}
