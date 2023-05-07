<?php

namespace App\Http\Controllers;

use App\Models\Merk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MerkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('merk.index');
    }

    public function read(){
        $merk = Merk::all();
        return view('merk.read')->with([
            'data' => $merk
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $max = Merk::max('kode');
        $kode = substr($max,3);
        $kode++;
        $huruf= "MRK";
        $maxkode = $huruf.sprintf("%03s",$kode);

        return view('merk.create',compact('maxkode'));
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

            $merk = new Merk;
            $merk->kode = $request->input('kode');
            $merk->nama = $request->input('nama');
            $merk->save();
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
        $data = Merk::find($uuid);
        return view('merk.edit', compact('data'));
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
            $merk = Merk::find($uuid);
            if($merk){
                $merk->kode = $request->input('kode');
                $merk->nama = $request->input('nama');
                $merk->update();
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
        Merk::destroy($uuid);
        return response()->json([
            'status' => 200,
        ]);
    }
}
