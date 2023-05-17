<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Create Data Pengadaan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
    
                        <h3 class="text-center">Data Pengadaan</h3>
                        <hr>
                        <div class="form-group">
                            <label>No Pengadaan</label>
                            <input type="text" id="no" value="{{ $maxkode }}" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Tgl Pengadaan</label>
                            <input type="date" id="tgl" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Supplier</label>
                            <select id="supplier" class="form-control" required>
                                <option>....</option>
                                @foreach ( $supplier as $x )
                                <option value="{{ $x->uuid }}">{{ $x->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jenis Pengadaan</label>
                            <select id="jenis" class="form-control" required>
                                <option>....</option>
                                @foreach ( $jenis as $x )
                                <option value="{{ $x->uuid }}">{{ $x->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" id="keterangan" class="form-control">
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
                                        <select id="barang" name="barang[]" class="form-control barang" required>
                                            <option>....</option>
                                            @foreach ( $barang as $x )
                                            <option value="{{ $x->uuid }}">{{ $x->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <input type="text" id="deskripsi" name="deskripsi[]" class="form-control deskripsi">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <input type="number" id="harga" name="harga[]" class="form-control harga">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>jumlah</label>
                                        <input type="number" id="jumlah" name="jumlah[]" class="form-control jumlah">
                                    </div>
                                </div>
                                <div class="col-1 mt-3">
                                    <button class="btn btn-info" onclick="addrow()"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <ul id="errorform"></ul>
            </div>
    
            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right" id="submitbtn" onclick="store()">Submit</button>
                <button type="button" class="btn btn-default" id="close-modal" data-dismiss="modal">Close</button>
            </div>
    </div>
</div>
