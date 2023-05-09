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
    protected $nullable = [
        'uuid_pengadaan','tahun_digunakan','nomor_seri','masa_habis_kalibrasi','no_sertifikat_kalibrasi','pembuat_sertifikat','asal_barang','keterangan','foto'
    ]; 
    protected $fillable = ['uuid_barang','uuid_lokasi','kode_aset','tahun_datang'];


}
