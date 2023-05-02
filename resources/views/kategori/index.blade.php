@extends('template.main')
@section('konten')
@section('title' ,'Halaman Kategori')
@section('page','Data Kategori')

<div class="card">
    <div class="card-header">
        <a href="/kategori/create" class="btn btn-primary">Tambah Data</a>
    </div>
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $data as $x)
                <tr>
                    <td>{{$x->kode}}</td>
                    <td>{{$x->nama}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>



@endsection
