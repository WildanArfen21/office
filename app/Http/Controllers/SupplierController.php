<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('supplier.index');
    }

    public function read(){
        $supplier = Supplier::all();
        return view('supplier.read')->with([
            'data' => $supplier
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $max = Supplier::max('kode');
        $kode = substr($max,3);
        $kode++;
        $huruf= "SPL";
        $maxkode = $huruf.sprintf("%03s",$kode);

        return view('supplier.create',compact('maxkode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'no' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
            ]);
        }else{

            $supplier = new Supplier();
            $supplier->kode = $request->input('kode');
            $supplier->nama = $request->input('nama');
            $supplier->alamat = $request->input('alamat');
            $supplier->no_telp = $request->input('no');
            $supplier->save();
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
        $data = Supplier::find($uuid);
        return view('supplier.edit', compact('data'));
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
            $supplier = Supplier::find($uuid);
            if($supplier){
                $supplier->kode = $request->input('kode');
                $supplier->nama = $request->input('nama');
                $supplier->alamat = $request->input('alamat');
                $supplier->no_telp = $request->input('no');
                $supplier->update();
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
        Supplier::destroy($uuid);
        return response()->json([
            'status' => 200,
        ]);
    }
}
