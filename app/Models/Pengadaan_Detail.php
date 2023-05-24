<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Pengadaan_Detail extends Model
{
    use HasFactory;
    use HasUuids;
    protected $table = 'pengadaan_details';
    protected $primaryKey = 'uuid';

    protected $fillable = ['uuid_pengadaan','uuid_barang','jumlah','harga','total','deskripsi_barang'];

    public function barang(){
        return $this->belongsTo(Barang::class, 'uuid_barang');
    }
    public function pengadaan(){
        return $this->belongsTo(Pengadaan::class, 'uuid_pengadaan');
    }
}
