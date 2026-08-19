<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kode_kantor extends Model
{
    //use HasFactory;
    protected $table = 'kode_kantors';
    protected $primarykey = "id";
    protected $fillable = [
        'id',
        'kode_kantor',
        'kode_kantor_slik',
        'kode_cabang',
        'nama_kantor',
        'kota_kantor',
    ];
}
