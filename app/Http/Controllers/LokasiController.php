<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lokasi;
use App\Models\Departemen;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $max = Lokasi::max('kode');
        $kode = substr($max,3);
        $kode++;
        $huruf= "LKS";
        $maxkode = $huruf.sprintf("%03s",$kode);
        $departemen = Departemen::all();
        if ($request->ajax()) {
            $data = Lokasi::with('departemen')->get();
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
        return view('lokasi.index',compact('maxkode','departemen'));
    }

    public function store(Request $request)
    {
        Lokasi::updateOrcreate(['uuid' => $request->uuid],[
            'kode'=>$request->kode,
            'nama'=>$request->nama,
            'uuid_departemen'=>$request->departemen,

        ]);
        return response()->json(['success'=>'Post saved successfully.']);

    }

    /**
     * Update the specified resource in storage.
     */
    public function edit($uuid)
    {
        $post = Lokasi::find($uuid);
        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        Lokasi::find($uuid)->delete();

        return response()->json(['success'=>'Post deleted successfully.']);
    }


}
