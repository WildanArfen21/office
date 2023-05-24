<?php

namespace App\Http\Controllers;

use App\Models\Jenis_Pengadaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class JenisPengadaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        if ($request->ajax()) {
            $data = Jenis_Pengadaan::all();
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
        return view('jenis-pengadaan.index');
    }

    public function store(Request $request)
    {
        Jenis_Pengadaan::updateOrcreate(['uuid' => $request->uuid],[

            'nama'=>$request->nama,
        ]);
        return response()->json(['success'=>'Post saved successfully.']);

    }

    /**
     * Update the specified resource in storage.
     */
    public function edit($uuid)
    {
        $post = Jenis_Pengadaan::find($uuid);
        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        Jenis_Pengadaan::find($uuid)->delete();

        return response()->json(['success'=>'Post deleted successfully.']);
    }
}
