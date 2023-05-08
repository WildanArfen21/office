<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartemenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('departemen.index');
    }

    public function read(){
        $departemen = Departemen::all();
        return view('departemen.read')->with([
            'data' => $departemen
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $max = Departemen::max('kode');
        $kode = substr($max,3);
        $kode++;
        $huruf= "DPT";
        $maxkode = $huruf.sprintf("%03s",$kode);

        return view('departemen.create',compact('maxkode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required',
            'nama' => 'required',
            'keterangan' => 'nullable',
        ]);

        if($validator->fails()){
            
        }else{

            $departemen = new Departemen;
            $departemen->kode = $request->input('kode');
            $departemen->nama = $request->input('nama');
            $departemen->keterangan = $request->input('keterangan');
            $departemen->save();
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
        $data = Departemen::find($uuid);
        return view('departemen.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required',
            'nama' => 'required',
            'keterangan' => 'nullable',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
            ]);
        }else{
            $departemen = Departemen::find($uuid);
            if($departemen){
                $departemen->kode = $request->input('kode');
                $departemen->nama = $request->input('nama');
                $departemen->keterangan = $request->input('keterangan');
                $departemen->update();
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
        Departemen::destroy($uuid);
        return response()->json([
            'status' => 200,
        ]);
    }
}
