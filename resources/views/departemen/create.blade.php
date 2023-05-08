<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Create Data Departemen</h4>
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
                <input type="text" name="nama" id="nama" class="form-control">
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
    