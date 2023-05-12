@extends('template.layout.filejs')
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Status</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $data as $x)
        <tr>
            <td>{{$x->karyawan->nama}}</td>
            <td>{{$x->tgl_peminjaman}}</td>
            <td>{{$x->tgl_akan_kembali}}</td>
            <td>{{$x->status}}</td>
            <td>{{$x->keterangan}}</td>
            <td>
                <a class="btn badge-warning" onclick="edit('{{ $x->uuid }}')">Edit</a>
                <a class="btn badge-danger" onclick="confirmdel('{{ $x->uuid }}')">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@section('datatables')
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

    </script>
    @endsection

