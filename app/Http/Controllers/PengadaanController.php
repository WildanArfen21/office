<?php

namespace App\Http\Controllers;

use App\Models\Pengadaan_detail;
use App\Models\Pengadaan;
use App\Models\Inventaris;
use App\Models\Jenis_Pengadaan;
use App\Models\Barang;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class PengadaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $max = Pengadaan::max('nomor_pengadaan');
        $kode = substr($max,3);
        $kode++;
        $huruf= "BB";
        $maxkode = $huruf.sprintf("%03s",$kode);
        $databarang = Barang::all();
        $datasupplier = Supplier::all();
        $datajenis = Jenis_Pengadaan::all();


        if ($request->ajax()) {
            $data = Pengadaan::with('jenis','supplier')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('aksi', function($row){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->uuid.'" data-original-title="Edit" class="edit btn btn-primary editPost">Edit</a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->uuid.'" data-original-title="Delete" class="btn btn-danger deletePost">Delete</a>';
                        $btn = $btn. '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->uuid.'" data-original-title="Detail" class="detail btn btn-success detailPost ml-1">Detail</a>';
                            return $btn;
                    })
                    ->rawColumns(['aksi'])
                    ->make(true);
        }
        return view('pengadaan.index',compact('maxkode','databarang','datasupplier','datajenis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $max = Pengadaan::max('nomor_pengadaan');
        $kode = substr($max,2);
        $kode++;
        $huruf= "BB";
        $maxkode = $huruf.sprintf("%03s",$kode);
        $jenis = Jenis_Pengadaan::all();
        $supplier = Supplier::all();
        $barang = Barang::all();

        return view('pengadaan.create', compact('jenis','supplier','maxkode','barang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        
        Pengadaan::create([
            'uuid_supplier'=> $request->input('supplier'),
            'uuid_jenis_pengadaan'=> $request->input('jenis'),
            'nomor_pengadaan'=> $request->input('no'),
            'tanggal_pengadaan'=> $request->input('tgl'),
            'keterangan'=> $request->input('keterangan'),
        ]);
        $datap = Pengadaan::where('nomor_pengadaan','=', $request->input('no'))->first();

        $total = [];
        foreach($request->jumlah as $indexjumlah => $value){
            $total[] = $value * $request->harga[$indexjumlah];
        }


        foreach($request->barang as $index => $value){
            Pengadaan_Detail::create([
                'uuid_barang' => $request->barang[$index],
                'uuid_pengadaan' => $datap->uuid,
                'deskripsi_barang' => $request->deskripsi[$index],
                'jumlah' => $request->jumlah[$index],
                'harga' => $request->harga[$index],
                'total'=> $total[$index],
            ]);
        }


        
        return response()->json(['success'=>'Post saved successfully.']);

        // $validator = Validator::make($request->all(), [
        //     'no' => 'required',
        //     'tgl' => 'required',
        //     'supplier' => 'required',
        //     'jenis' => 'required',
        //     'keterangan' => 'nullable',
        //     'barang' => 'required',
        //     'deskripsi' => 'nullable',
        //     'harga' => 'required',
        //     'jumlah' => 'required',
        // ]);

        // if($validator->fails()){
        //     return response()->json([
        //         'status' => 400,
        //     ]);
        // }else{

        //     $pengadaan = new Pengadaan();
        //     $pengadaan->uuid_supplier = $request->input('supplier');
        //     $pengadaan->uuid_jenis_pengadaan = $request->input('jenis');
        //     $pengadaan->nomor_pengadaan = $request->input('no');
        //     $pengadaan->tanggal_pengadaan = $request->input('tgl');
        //     $pengadaan->keterangan = $request->input('keterangan');
        //     $pengadaan->save();

        //     $datap = Pengadaan::where('nomor_pengadaan','=', $request->input('no'))->first();

        //     $detail = new Pengadaan_detail();
        //     $detail->uuid_pengadaan = $datap->uuid;
        //     $detail->uuid_barang = $request->input('barang');
        //     $detail->jumlah = $request->input('jumlah');
        //     $detail->harga = $request->input('harga');
        //     $detail->total = $request->input('harga') * $request->input('jumlah');
        //     $detail->save();

        //     $kobar = Barang::where('uuid','=',$request->input('barang'))->first();
            
        //     $noset = Inventaris::max('kode_aset');
        //     $nomoraset = substr($noset,7);
        //     $nomoraset++;
        //     $kodeaset = $kobar->kode.".".sprintf('%03s',$nomoraset);

        //     $tgl = substr($request->input('tgl'),0,4);

        //     $inven = new Inventaris();
        //     $inven->uuid_pengadaan = $datap->uuid;
        //     $inven->uuid_barang = $request->input('barang');
        //     $inven->kode_aset = $kodeaset;
        //     $inven->tahun_datang =  $tgl;
        //     $inven->harga_barang = $request->input('harga');
        //     $inven->status = "Tersedia";
        //     $inven->save();



        //     return response()->json([
        //         'status' => 200,
        //     ]);
        // }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        $jenis = Jenis_Pengadaan::all();
        $supplier = Supplier::all();
        $data = Pengadaan::find($uuid);
        return view('pengadaan.edit', compact('data','jenis','supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'jenis' => 'required',
            'no' => 'required',
            'tgl' => 'required',
            'keterangan' => 'nullable',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
            ]);
        }else{
            $pengadaan = Pengadaan::find($uuid);
            if($pengadaan){
                $pengadaan->uuid_supplier = $request->input('nama');
                $pengadaan->uuid_jenis_pengadaan = $request->input('jenis');
                $pengadaan->nomor_pengadaan = $request->input('no');
                $pengadaan->tanggal_pengadaan = $request->input('tgl');
                $pengadaan->keterangan = $request->input('keterangan');
                $pengadaan->update();
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
        Pengadaan::destroy($uuid);
        return response()->json([
            'status' => 200,
        ]);
    }
}
