@extends('template.main')
@section('konten')
@section('title' ,'Halaman Pengadaan')
@section('page','Data Pengadaan')

<div class="card">
    <div class="card-header">
        {{-- <a href="/kategori/create" class="btn btn-primary">Tambah Data</a> --}}
        <button type="button" id="btn-modal" style="display: none;" class="btn btn-primary" data-toggle="modal"
            data-target="#modal-default">
            Create
        </button>
        <button onclick="create()" class="btn btn-primary">Create</button>
        <div id="success" class="text-center"></div>
    </div>
    <div class="card-body" id="read">


    </div>
    <!-- /.card-body -->
</div>

{{-- <div class="modal fade show" id="modal-default" style="display: block; padding-right: 17px;" aria-modal="true" role="dialog"> --}}
<div class="modal fade bd-example-modal-lg" id="modal-default" style="display: none;" aria-hidden="true" role="dialog" role="dialog">
    <div class="modal-dialog modal-xl" id="modal">
        {{-- @include('kategori.create') --}}
    </div>

</div>
@endsection
@section('js')


<script type="text/javascript">
    function read() {
        $.get("{{ url('pengadaan/read') }}", {}, function (data, status) {
            $('#close-modal').click();
            $('#close-modal').click();
            $("#read").html(data);
        });
    }

    function create() {

        $.get("{{ url('pengadaan/create') }}", {}, function (data, status) {

            $('#btn-modal').click();

            $("#modal").html(data);
        });
    }


    function store() {

        var data = {
            'no': $('#no').val(),
            'tgl': $('#tgl').val(),
            'supplier': $('#supplier').val(),
            'jenis': $('#jenis').val(),
            'keterangan': $('#keterangan').val(),
            'barang': $('#barang').val(),
            'deskripsi': $('#deskripsi').val(),
            'harga': $('#harga').val(),
            'jumlah': $('#jumlah').val(),
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "{{ url('pengadaan/store') }}",
            data: data,
            dataType: "json",
            success: function (response) {
                console.log(response);
                if (response.status == 400) {
                    inputalert();
                } else {
                    closemodal();
                    save();
                    read();
                }
            }
        });
    }

    function edit(uuid) {
        $.get(`{{ url('pengadaan/${uuid}/edit') }}`, {}, function (data, status) {
            $('#btn-modal').click();
            $("#modal").html(data);
        });
    }

    function update(uuid) {

        var data = {
            'nama': $('#nama').val(),
            'jenis': $('#jenis').val(),
            'no': $('#no').val(),
            'tgl': $('#tgl').val(),
            'keterangan': $('#keterangan').val(),
        }


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "PUT",
            url: `{{ url('pengadaan/${uuid}/update') }}`,
            data: data,
            dataType: "json",
            success: function (response) {
                // console.log(response);
                if (response.status == 400) {
                    inputalert();
                } else if (response.status == 404) {
                    notfound();
                } else {
                    closemodal();
                    updatesuccess();
                    read();
                }
            }
        });
    }

    function confirmdel(uuid) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                destroy(uuid);
            }
        });
    }

    function destroy(uuid) {
        $.ajax({
            type: "get",
            url: `{{ url('pengadaan/${uuid}/destroy') }}`,
            dataType: "json",
            success: function (response) {
                // console.log(response);

                if (response.status == 200) {
                    closemodal();
                    deletesuccess();
                    read();
                }
            }
        });
    }

    function closemodal(){
        $('#close-modal').click();
        $('#close-modal').click();
    }


    function addrow(){
        var add = '';
        add+='<div class="row">';
        add+='<div class="col-3" id="child"><div class="form-group"><select id="barang" name="barang[]" class="form-control" required>@foreach($barang as $x )<option>....</option><option value="{{ $x->uuid }}">{{ $x->nama }}</option>@endforeach</select></div></div>';
        add+='<div class="col-3"><div class="form-group"><input type="text" id="deskripsi" name="deskripsi[]" value="" class="form-control"></div></div>';
        add+='<div class="col-3"><div class="form-group"><input type="number" id="harga" name="harga[]"  class="form-control"></div></div>';
        add+='<div class="col-2"><div class="form-group"><input type="number" id="jumlah" name="jumlah[]" class="form-control"></div></div>';
        add+='<div class="col-1"><button class="btn btn-danger remove"><i class="fas fa-times"></i></button></div>';
        add+='</div>';
        $('#addrow').append(add);
    }

    $(document).on('click','.remove',  function (e){
        $(this).parent().parent().remove();
    })


</script>

@endsection
