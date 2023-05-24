<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class DepartemenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $max = Departemen::max('kode');
        $kode = substr($max,3);
        $kode++;
        $huruf= "DPT";
        $maxkode = $huruf.sprintf("%03s",$kode);
        if ($request->ajax()) {
            $data = Departemen::all();
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
        return view('departemen.index',compact('maxkode'));
    }

    public function store(Request $request)
    {
        Departemen::updateOrcreate(['uuid' => $request->uuid],[
            'kode'=>$request->kode,
            'nama'=>$request->nama,
            'keterangan'=>$request->keterangan,
        ]);
        return response()->json(['success'=>'Post saved successfully.']);

    }

    /**
     * Update the specified resource in storage.
     */
    public function edit($uuid)
    {
        $post = Departemen::find($uuid);
        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        Departemen::find($uuid)->delete();

        return response()->json(['success'=>'Post deleted successfully.']);
    }
}
