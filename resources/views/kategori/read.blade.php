<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $data as $x)
        <tr>
            <td>{{$x->kode}}</td>
            <td>{{$x->nama}}</td>

            <td>
                <a class="btn badge-warning" href="/kategori/{{ $x->uuid }}/edit">Edit</a>
                <a class="btn badge-danger" href="">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
