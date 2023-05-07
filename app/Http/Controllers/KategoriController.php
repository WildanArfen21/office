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
        return view('kategori.index');
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
        $max = Kategori::max('kode');
        $kode = substr($max,3);
        $kode++;
        $huruf= "KTG";
        $maxkode = $huruf.sprintf("%03s",$kode);

        return view('kategori.create',compact('maxkode'));
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

            $kategori = new Kategori;
            $kategori->kode = $request->input('kode');
            $kategori->nama = $request->input('nama');
            $kategori->save();
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
        $data = Kategori::find($uuid);
        return view('kategori.edit', compact('data'));
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
            $kategori = Kategori::find($uuid);
            if($kategori){
                $kategori->kode = $request->input('kode');
                $kategori->nama = $request->input('nama');
                $kategori->update();
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
        Kategori::destroy($uuid);
        return response()->json([
            'status' => 200,
        ]);
    }

    
}
