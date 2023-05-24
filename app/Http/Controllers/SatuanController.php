<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $max = Satuan::max('kode');
        $kode = substr($max,3);
        $kode++;
        $huruf= "STN";
        $maxkode = $huruf.sprintf("%03s",$kode);
        if ($request->ajax()) {
            $data = Satuan::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('aksi', function($row){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->uuid.'" data-original-title="Edit" class="edit btn btn-primary editPost">Edit</a>';
                        $btn = $btn.' <a href="javascript:void(0)" onclick="return confirm(`Yakin Di Hapus?`)" data-toggle="tooltip"  data-id="'.$row->uuid.'" data-original-title="Delete" class="btn btn-danger deletePost">Delete</a>';
                            return $btn;
                    })
                    ->rawColumns(['aksi'])
                    ->make(true);
        }
        return view('satuan.index',compact('maxkode'));
    }

    public function store(Request $request)
    {
        Satuan::updateOrcreate(['uuid' => $request->uuid],[
            'kode'=>$request->kode,
            'nama'=>$request->nama,
        ]);
        return response()->json(['success'=>'Post saved successfully.']);

    }

    /**
     * Update the specified resource in storage.
     */
    public function edit($uuid)
    {
        $post = Satuan::find($uuid);
        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        Satuan::find($uuid)->delete();

        return response()->json(['success'=>'Post deleted successfully.']);
    }
}
