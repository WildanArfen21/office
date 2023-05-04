<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $max = Kategori::max('kode');
        $kode = substr($max,3);
        $kode++;
        $huruf= "KTG";
        $maxkode = $huruf.sprintf("%03s",$kode);

        return view('kategori.index',compact('maxkode'));
    }

    public function read(){
        

        $kategori = Kategori::all();
        return view('kategori.read')->with([
            'data' => $kategori
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */

    public function create(){
        return view('kategori.create');
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
                'errors' => $validator->messages(),
                'err' => 'Data Gagal Ditambahkan'
            ]);
        }else{
            $kategori = new Kategori;
            $kategori->uuid=\Ramsey\Uuid\Uuid::uuid4()->toString();
            $kategori->kode = $request->input('kode');
            $kategori->nama = $request->input('nama');
            $kategori->save();
            return response()->json([
                'status' => 200,
                'message' => 'Data Berhasil Ditambahkan',
            ]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        $data = Kategori::all();
        dd($data);
        return view('kategori.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        //
    }
}
