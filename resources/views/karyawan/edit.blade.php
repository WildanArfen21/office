<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Edit Data Karyawan</h4>
        <button id="btn-close" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="card-body">
            <ul id="errorform"></ul>
            <div class="form-group">
                <label>Kode</label>
                <input type="text" name="kode" id="kode" value="{{$data->kode}}" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label>Nama</label>
                <input type="text" id="nama" class="form-control" value="{{$data->nama}}" required>
            </div>
            <div class="form-group">
                <label>Username</label>
                <select class="form-control" id="user">
                <option>...</option>
                @foreach($user as $x)
                <option @if ($data->uuid_user == $x->uuid ) selected @endif value=" {{$x->uuid }} " > {{ $x->username}} </option>
                @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Gender</label>
                <select class="form-control" id="gender">
                    <option @if ($data->jenis_kelamin == 'Laki-Laki') selected @endif value="Laki-laki">Laki-laki</option>
                    <option @if ($data->jenis_kelamin == 'Perempuan') selected @endif value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" id="alamat" class="form-control" value="{{$data->alamat}}" required>
            </div>
            <div class="form-group">
                <label>No Telp</label>
                <input type="text" id="no_telp" class="form-control" value="{{$data->no_telp}}" required>
            </div>
            <div class="form-group">
                <label>Foto</label>
                <input type="file" id="foto" class="form-control" required>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary float-right" id="submitbtn" onclick="update('{{ $data->uuid }}')">Submit</button>
            <button type="button" class="btn btn-default" id="close-modal" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
