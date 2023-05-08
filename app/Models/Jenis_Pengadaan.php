<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Jenis_Pengadaan extends Model
{
    use HasFactory;
    use HasUuids;
    protected $table = 'jenis_pengadaans';
    protected $primaryKey = 'uuid';
    protected $fillable = ['nama'];

    public function pengadaan(){
        return $this->hasMany(Pengadaan::class);
    }
}
