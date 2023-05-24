<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Inventaris extends Model
{
    use HasFactory;
    use HasUuids;
    protected $primaryKey = 'uuid';
    protected $fillable = ['uuid_barang','uuid_lokasi','kode_aset','tahun_datang','status','uuid_pengadaan','tahun_digunakan','nomor_seri','masa_habis_kalibrasi','no_sertifikat_kalibrasi','pembuat_sertifikat','asal_barang','keterangan','foto'];

    public function barang(){
        return $this->belongsTo(Barang::class, 'uuid_barang');
    }
    public function lokasi(){
        return $this->belongsTo(Lokasi::class, 'uuid_lokasi');
    }
    public function pengadaan(){
        return $this->belongsTo(Pengadaan::class, 'uuid_pengadaan');
    }


}
