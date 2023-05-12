<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Edit Data Peminjaman</h4>
        <button id="btn-close" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="card-body">
            <ul id="errorform"></ul>
            <div class="form-group">
                <label>Nama</label>
                <select class="form-control" id="nama">
                <option>...</option>
                @foreach($karyawan as $x)
                <option @if ($data->uuid_karyawan == $x->uuid ) selected @endif value=" {{$x->uuid }} " > {{ $x->nama}} </option>
                @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Tanggal Peminjaman</label>
                <input type="date" name="nama" id="tgl_peminjaman" value="{{ $data->tgl_peminjaman }}" class="form-control">

            </div>
            <div class="form-group">
                <label>Tanggal Akan Dikembalikan</label>
                <input type="date" name="nama" id="tgl_akan_kembali" value="{{ $data->tgl_akan_kembali }}" class="form-control">

            </div>
            <div class="form-group">
                <label>Status</label>
                <select class="form-control" id="status">
                    <option @if ($data->status == 'Sedang Dipinjam') selected @endif value="Sedang Dipinjam">Sedang Dipinjam</option>
                    <option @if ($data->status == 'Sudah Dikembalkan') selected @endif value="Sudah Dikembalikan">Sudah Dikembalkan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <input type="text" name="nama" id="keterangan" value="{{ $data->keterangan }}" class="form-control">

            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary float-right" id="submitbtn" onclick="update('{{ $data->uuid }}')">Submit</button>
            <button type="button" class="btn btn-default" id="close-modal" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
