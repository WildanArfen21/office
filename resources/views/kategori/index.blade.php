@extends('template.main')
@section('konten')
@section('title' ,'Halaman Kategori')
@section('page','Data Kategori')

<div class="card">
    <div class="card-header">
        {{-- <a href="/kategori/create" class="btn btn-primary">Tambah Data</a> --}}
        <button type="button" id="createNewPost" class="btn btn-primary" data-toggle="modal"
            data-target="#modal-default">
            Create
        </button>
        <div id="success" class="text-center"></div>
    </div>
    <div class="card-body" id="read">

        <table id="example1" class="table table-bordered table-striped data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>

<div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" id="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form id="postForm">
                        <div class="form-group">
                            <label>Kode</label>
                            <input type="text" name="kode" id="kode" value="{{ $maxkode }}" class="form-control"
                                readonly>
                            <input type="hidden" name="uuid" id="uuid">
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control">
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right" id="savedata">Submit</button>
                    <button type="button" class="btn btn-default" id="close-modal" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
@section('js')

<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('kategori.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'kode',
                    name: 'kode'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                },
            ]
        });

        $('#createNewPost').click(function () {
            $('#savedata').val("create-post");
            $('#postForm').trigger("reset");
            $('#modelHeading').html("Create Data Kategori");
        });

        $('#savedata').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
                data: $('#postForm').serialize(),
                url: "{{ route('kategori.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {

                    $('#postForm').trigger("reset");
                    $('#close-modal').click();
                    table.draw();

                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#savedata').html('Save Changes');
                }
            });
        });

        $('body').on('click', '.editPost', function () {
            var uuid = $(this).data('id');
            $.get(`{{ url('kategori/${uuid}/edit') }}`, function (data) {
                $('#createNewPost').click();
                $('#modelHeading').html("Edit Data Kategori");
                $('#savedata').val("edit-user");
                $('#kode').val(data.kode);
                $('#uuid').val(data.uuid);
                $('#nama').val(data.nama);
            })
        });

        $('body').on('click', '.deletePost', function () {

            var uuid = $(this).data("id");
            confirm("Are You sure want to delete this Post!");

            $.ajax({
                type: "DELETE",
                url: "{{ route('kategori.store') }}" + '/' + uuid,
                success: function (data) {
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });



    });


    function read() {
        $.get("{{ url('kategori/read') }}", {}, function (data, status) {
            $('#close-modal').click();
            $('#close-modal').click();
            $("#read").html(data);
        });
    }

    function create() {

        $.get("{{ url('kategori/create') }}", {}, function (data, status) {

            $('#btn-modal').click();

            $("#modal").html(data);
        });
    }


    function store() {

        var data = {
            'nama': $('#nama').val(),
            'kode': $('#kode').val(),
        }


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "{{ url('kategori/store') }}",
            data: data,
            dataType: "json",
            success: function (response) {
                // console.log(response);
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
        $.get(`{{ url('kategori/${uuid}/edit') }}`, {}, function (data, status) {
            $('#btn-modal').click();
            $("#modal").html(data);
        });
    }

    function update(uuid) {

        var data = {
            'nama': $('#nama').val(),
            'kode': $('#kode').val(),
        }


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "PUT",
            url: `{{ url('kategori/${uuid}/update') }}`,
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
            url: `{{ url('kategori/${uuid}/destroy') }}`,
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

    function closemodal() {
        $('#close-modal').click();
        $('#close-modal').click();
    }

</script>


@endsection
