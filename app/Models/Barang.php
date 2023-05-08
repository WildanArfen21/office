<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Barang extends Model
{
    use HasFactory;
    use HasUuids;

    protected $primaryKey = 'uuid';
    protected $fillable = ['kode','nama','uuid_kategori','uuid_merk','uuid_satuan'];

    public function kategori(){
        return $this->belongsTo(Kategori::class , 'uuid_kategori');
    }
    public function merk(){
        return $this->belongsTo(Merk::class , 'uuid_merk');
    }
    public function satuan(){
        return $this->belongsTo(Satuan::class , 'uuid_satuan');
    }

    public function pengadaanDetail(){
        return $this->hasMany(Pengadaan_Detail::class);
    }
}
