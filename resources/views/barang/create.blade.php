<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Create Data Barang</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="card-body">
            <ul id="errorform"></ul>
            <div class="form-group">
                <label>Kode</label>
                <input type="text" name="kode" id="kode" value="{{ $maxkode }}" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label>Nama</label>
                <input type="text" id="nama" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <select id="kategori" class="form-control" required>
                    @foreach ( $kategori as $x )
                        <option value="{{ $x->uuid }}">{{ $x->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Merk</label>
                <select id="merk" class="form-control" required>
                    @foreach ( $merk as $x )
                        <option value="{{ $x->uuid }}">{{ $x->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Satuan</label>
                <select id="satuan" class="form-control" required>
                    @foreach ( $satuan as $x )
                        <option value="{{ $x->uuid }}">{{ $x->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary float-right" id="submitbtn" onclick="store()">Submit</button>
            <button type="button" class="btn btn-default" id="close-modal" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
    