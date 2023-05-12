<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Create Data Peminjaman</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                <option value=" {{$x->uuid }} " > {{ $x->nama}} </option>
                @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Tanggal Pinjam</label>
                <input type="date" id="tgl_peminjaman" class="form-control">
            </div>
            <div class="form-group">
                <label>Tanggal Kembali</label>
                <input type="date" id="tgl_akan_kembali" class="form-control">
            </div>
            <div class="form-group">
                <label>Status</label>
                <select class="form-control" id="status">
                    <option value="Sedang Dipinjam">Sedang Dipinjam</option>
                    <option value="Sudah Dikembalikan">Sudah Dikembalikan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <input type="text" id="keterangan" class="form-control">
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary float-right" id="submitbtn" onclick="store()">Submit</button>
            <button type="button" class="btn btn-default" id="close-modal" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
