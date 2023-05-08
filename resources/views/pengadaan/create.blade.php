<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Create Data Pengadaan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="card-body">
            <ul id="errorform"></ul>
            <div class="form-group">
                <label>Nama</label>
                <select id="nama" class="form-control">
                    <option>-- Pilih Nama --</option>
                    @foreach ( $supplier as $x )
                        <option value="{{ $x->uuid }}">{{ $x->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Jenis Pengadaan</label>
                <select id="jenis" class="form-control">
                    <option>-- Pilih Jenis --</option>
                    @foreach ( $jenis as $x)
                        <option value="{{ $x->uuid }}">{{ $x->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>No Pengadaan</label>
                <input type="number" id="no" class="form-control">
            </div>
            <div class="form-group">
                <label>Tgl Pengadaan</label>
                <input type="date" id="tgl" class="form-control">
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
    