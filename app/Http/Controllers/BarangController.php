<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Merk;
use App\Models\Satuan;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $max = Barang::max('kode');
        $kode = substr($max,3);
        $kode++;
        $huruf= "BRG";
        $maxkode = $huruf.sprintf("%03s",$kode);
        $kategori = Kategori::all();
        $merk = Merk::all();
        $satuan = Satuan::all();
        if ($request->ajax()) {
            $data = Barang::with('kategori','merk','satuan')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('aksi', function($row){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->uuid.'" data-original-title="Edit" class="edit btn btn-primary editPost">Edit</a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->uuid.'" data-original-title="Delete" class="btn btn-danger deletePost">Delete</a>';
                            return $btn;
                    })
                    ->rawColumns(['aksi'])
                    ->make(true);
        }
        return view('barang.index',compact('maxkode','kategori','merk','satuan'));
    }

    public function store(Request $request)
    {
        Barang::updateOrcreate(['uuid' => $request->uuid],[
            'kode'=>$request->kode,
            'nama'=>$request->nama,
            'uuid_kategori'=>$request->kategori,
            'uuid_merk'=>$request->merk,
            'uuid_satuan'=>$request->satuan,

        ]);
        return response()->json(['success'=>'Post saved successfully.']);

    }

    /**
     * Update the specified resource in storage.
     */
    public function edit($uuid)
    {
        $post = Barang::find($uuid);
        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        Barang::find($uuid)->delete();

        return response()->json(['success'=>'Post deleted successfully.']);
    }


}
