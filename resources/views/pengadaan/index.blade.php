@extends('template.main')
@section('konten')
@section('title' ,'Halaman Pengadaan')
@section('page','Data Pengadaan')

<div class="card">
    <div class="card-header">
        {{-- <a href="/pengadaan/create" class="btn btn-primary">Tambah Data</a> --}}
        <button type="button" id="createNewPost" class="btn btn-primary" data-toggle="modal"
            data-target="#modal-default">
            Create
        </button>
        <div id="success" class="text-center"></div>
    </div>
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>No Pengadaan</th>
                    <th>Tgl Pengadaan</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

    </div>
    <!-- /.card-body -->
</div>

{{-- <div class="modal fade show" id="modal-default" style="display: block; padding-right: 17px;" aria-modal="true" role="dialog"> --}}
<div class="modal fade bd-example-modal-lg" id="modal-default" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl" id="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="postForm">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">

                                <h3 class="text-center">Data Pengadaan</h3>
                                <hr>
                                <div class="form-group">
                                    <label>No Pengadaan</label>
                                    <input type="text" id="no" name="no" value="{{ $maxkode }}" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Tgl Pengadaan</label>
                                    <input type="date" id="tgl" name="tgl" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Supplier</label>
                                    <select id="supplier" name="supplier" class="form-control" required>
                                        <option>....</option>
                                        @foreach ( $datasupplier as $x )
                                        <option value="{{ $x->uuid }}">{{ $x->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Pengadaan</label>
                                    <select id="jenis" name="jenis" class="form-control" required>
                                        <option>....</option>
                                        @foreach ( $datajenis as $x )
                                        <option value="{{ $x->uuid }}">{{ $x->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" id="keterangan" name="keterangan" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h3 class="text-center">Data Barang</h3>
                                <hr>
                                <div id="addrow">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>Nama Barang</label>
                                                <select id="barang" name="barang[]" class="form-control barang"
                                                    required>
                                                    <option>....</option>
                                                    @foreach ( $databarang as $x )
                                                    <option value="{{ $x->uuid }}">{{ $x->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>Deskripsi</label>
                                                <input type="text" id="deskripsi" name="deskripsi[]"
                                                    class="form-control deskripsi">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>Harga</label>
                                                <input type="number" id="harga" name="harga[]"
                                                    class="form-control harga">
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label>jumlah</label>
                                                <input type="number" id="jumlah" name="jumlah[]"
                                                    class="form-control jumlah">
                                            </div>
                                        </div>
                                        <div class="col-1 mt-3">
                                            <a class="btn btn-info" onclick="addrow()"><i
                                                    class="fas fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right" id="savedata"
                            onclick="store()">Submit</button>
                        <a class="btn btn-default" id="close-modal"
                            data-dismiss="modal">Close</a>
                    </div>
                </div>
            </form>
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
            ajax: "{{ route('pengadaan.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'supplier.nama',
                    name: 'supplier'
                },
                {
                    data: 'jenis.nama',
                    name: 'jenis'
                },
                {
                    data: 'nomor_pengadaan',
                    name: 'no'
                },
                {
                    data: 'tanggal_pengadaan',
                    name: 'tgl'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
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
            $('#modelHeading').html("Create Data Pengadaan");
        });

        $('#savedata').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
                data: $('#postForm').serialize(),
                url: "{{ route('pengadaan.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $(this).html('Submit');
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

    })


    function addrow() {
        var add = '';
        add += '<div class="row">';
        add +=
        '<div class="col-3"><div class="form-group"><select id="barang" name="barang[]" class="form-control barang" required><option>....</option> @foreach ( $databarang as $x )<option value="{{ $x->uuid }}">{{ $x->nama }}</option>@endforeach</select></div></div>';
        add +=
            '<div class="col-3"><div class="form-group"><input type="text" id="deskripsi" name="deskripsi[]" class="form-control deskripsi"></div></div>';
        add +=
            '<div class="col-3"><div class="form-group"><input type="number" id="harga" name="harga[]" class="form-control harga"></div></div>';
        add +=
            '<div class="col-2"> <div class="form-group"><input type="number" id="jumlah" name="jumlah[]" class="form-control jumlah"> </div> </div>';
        add += '<div class="col-1"><a class="btn btn-danger remove"><i class="fas fa-times"></i></a></div>';
        add += '</div>';
        $('#addrow').append(add);
    }

    $(document).on('click', '.remove', function (e) {
        $(this).parent().parent().remove();
    })

</script>

@endsection
