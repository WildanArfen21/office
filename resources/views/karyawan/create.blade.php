select<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Create Data Karyawan</h4>
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
                <label>Username</label>
                <select class="form-control" id="user">
                <option>...</option>
                @foreach($user as $x)
                <option value=" {{$x->uuid }} " > {{ $x->username}} </option>
                @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Gender</label>
                <select class="form-control" id="gender">
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" id="alamat" class="form-control" required>
            </div>
            <div class="form-group">
                <label>No Telp</label>
                <input type="text" id="no_telp" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Foto</label>
                <input type="file" id="foto" class="form-control" required>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary float-right" id="submitbtn" onclick="store()">Submit</button>
            <button type="button" class="btn btn-default" id="close-modal" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
