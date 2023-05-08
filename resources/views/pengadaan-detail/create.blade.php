<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Create Data Pengadaan Detail</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="card-body">
            <ul id="errorform"></ul>
            <div class="form-group">
                <label>Nama Barang</label>
                <select id="nama" class="form-control">
                    <option>-- Pilih Nama --</option>
                    @foreach ( $barang as $x )
                        <option value="{{ $x->uuid }}">{{ $x->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Nomor Pengadaan</label>
                <select id="no" class="form-control">
                    <option>-- Nomor Pengadaan --</option>
                    @foreach ( $pengadaan as $x)
                        <option value="{{ $x->uuid }}">{{ $x->nomor_pengadaan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Jumlah</label>
                <input type="number" id="jumlah" class="form-control">
            </div>
            <div class="form-group">
                <label>Harga</label>
                <input type="number" id="harga" class="form-control">
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <input type="text" id="deskripsi" class="form-control">
            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary float-right" id="submitbtn" onclick="store()">Submit</button>
            <button type="button" class="btn btn-default" id="close-modal" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
    