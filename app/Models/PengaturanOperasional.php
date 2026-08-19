<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanOperasional extends Model
{
    protected $table = 'pengaturan_operasional';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kode_kantor',
        'jabatan',
        'nama',
    ];
}
