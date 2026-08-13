<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pincab extends Model
{
    protected $table = 'pincab';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'kode_kantor',
        'nama_pimpinan',
    ];
}
