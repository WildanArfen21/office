<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Departemen extends Model
{
    use HasFactory;
    use HasUuids;
    protected $primaryKey = 'uuid';
    protected $nullable = ['keterangan'];
    protected $fillable = ['kode','nama'];

    public function lokasi(){
        return $this->hasMany(Lokasi::class);
    }
}
