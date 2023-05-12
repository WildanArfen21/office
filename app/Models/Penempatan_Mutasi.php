<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Penempatan_Mutasi extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = "penempatan_mutasis";
    protected $primaryKey = 'uuid';
    protected $nullable = "keterangan";
    protected $fillable = ['uuid_lokasi','uuid_karyawan','nomor','tanggal','jenis'];

    public function lokasi(){
        return $this->belongsTo(Lokasi::class , 'uuid_lokasi');
    }
    public function karyawan(){
        return $this->belongsTo(Karyawan::class , 'uuid_karyawan');
    }
}
