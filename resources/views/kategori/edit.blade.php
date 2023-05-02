@extends('template.main')
@section('konten')
@section('title' ,'Halaman Edit Kategori')
@section('page','Edit Kategori')
<div class="card card-primary">
    <form action="/kategori" method="post">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control">
                {{-- <input type="hidden" name="kode" value="{{ $data }}" class="form-control"> --}}
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary float-right">Submit</button>
            <a href="/kategori" class="btn btn-success ">Back</a>
        </div>
    </form>
</div>
</div>
@endsection
