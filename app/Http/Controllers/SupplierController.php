<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $max = Supplier::max('kode');
        $kode = substr($max,3);
        $kode++;
        $huruf= "SPL";
        $maxkode = $huruf.sprintf("%03s",$kode);
        if ($request->ajax()) {
            $data = Supplier::all();
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
        return view('supplier.index',compact('maxkode'));
    }

    public function store(Request $request)
    {
        Supplier::updateOrcreate(['uuid' => $request->uuid],[
            'kode'=>$request->kode,
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'no_telp'=>$request->no_telp,
        ]);
        return response()->json(['success'=>'Post saved successfully.']);

    }

    /**
     * Update the specified resource in storage.
     */
    public function edit($uuid)
    {
        $post = Supplier::find($uuid);
        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        Supplier::find($uuid)->delete();

        return response()->json(['success'=>'Post deleted successfully.']);
    }
}
