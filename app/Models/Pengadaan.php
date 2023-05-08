<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Pengadaan extends Model
{
    use HasFactory;
    use HasUuids;
    protected $primaryKey = 'uuid';
    protected $fillable = ['uuid_supplier','uuid_jenis_pengadaan','nomor_pengadaan','tanggal_pengadaan','keterangan'];

    public function jenis(){
        return $this->belongsTo(Jenis_Pengadaan::class, 'uuid_jenis_pengadaan');
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class, 'uuid_supplier');
    }

    public function pengadaanDetail(){
        return $this->hasMany(Pengadaan_Detail::class);
    }
}
