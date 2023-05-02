@extends('template.main')
@section('konten')
@section('title' ,'Halaman Tambah Kategori')
@section('page','Tambah Kategori')
<div class="card card-primary">
    <form method="post">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control">
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
</div>
@endsection