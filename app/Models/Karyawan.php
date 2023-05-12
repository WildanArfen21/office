<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Karyawan extends Model
{
    use HasFactory;
    use HasUuids;
    protected $primaryKey = 'uuid';
    protected $nullable = "foto";
    protected $fillable = ['uuid_user','kode','nama','jenis_kelamin','alamat','no_telp'];

    public function user(){
        return $this->belongsTo(User::class , 'uuid_user');
    }

    public function peminjaman(){
        return $this->hasMany(Peminjaman::class);
    }
    public function penempatan_mutasi(){
        return $this->hasMany(Penempatan_Mutasi::class);
    }
}
