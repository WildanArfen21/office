<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Peminjaman extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = "peminjamans";
    protected $primaryKey = 'uuid';
    protected $nullable = "keterangan";
    protected $fillable = ['uuid_karyawan','tgl_peminjaman','tgl_akan_kembali','status'];

    public function karyawan(){
        return $this->belongsTo(Karyawan::class , 'uuid_karyawan');
    }
}
