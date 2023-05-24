<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Create Data Penempatan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="card-body">
            <ul id="errorform"></ul>
            <div class="form-group">
                <label>Nomor Mutasi</label>
                <input type="text" name="nomor" id="nomor" value="{{ $maxkode }}" class="form-control" readonly>
            </div>
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
                <label>Lokasi</label>
                <select class="form-control" id="lokasi">
                <option>...</option>
                @foreach($lokasi as $x)
                <option value=" {{$x->uuid }} " > {{ $x->nama}} </option>
                @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" id="tanggal" class="form-control">
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <input type="text" id="keterangan" class="form-control">
            </div>
            <div class="form-group">
                <label>Jenis</label>
                <select class="form-control" id="jenis">
                    <option value="Penempatan">Penempatan</option>
                    <option value="Mutasi">Mutasi</option>
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
