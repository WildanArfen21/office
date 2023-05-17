<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Lokasi extends Model
{
    use HasFactory;
    use HasUuids;
    protected $primaryKey = 'uuid';
    protected $fillable = ['uuid_departemen','kode','nama'];

    public function departemen(){
        return $this->belongsTo(Departemen::class, 'uuid_departemen');
    }

     public function penempatan_mutasi(){
        return $this->hasMany(Penempatan_Mutasi::class);
     }
    public function inventaris(){
        return $this->hasMany(Inventaris::class);
    }
}
