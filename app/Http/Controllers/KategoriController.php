<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $max = Kategori::max('kode');
        $kode = substr($max,3);
        $kode++;
        $huruf = "KTG";
        $maxkode = $huruf.sprintf("%03s", $kode);

        $data = Kategori::all();
        return view('kategori.index', compact('data','maxkode'));
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'kode' => 'required',
            'nama' => 'required',
        ]);

        Kategori::create([
            'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            'kode' => $request->kode,
            'nama' => $request->nama,
        ]);
        return redirect('kategori');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        $data = Kategori::all();
        dd($data);
        return view('kategori.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        //
    }
}
