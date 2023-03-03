<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pjkkendaraan extends Model
{
    protected $table = 'pjkkendaraan';
    protected $primarykey = "id";
    protected $fillable = [
        'id',
        'kantor_id',
        'nopol',
        'tgl_habis_stnk',
        'tgl_pajak_tahunan',
        'nilai_pajak',
        'pemegang_kendaraan',
        'status_bayar',
        'keterangan',
    ];
    public function kantor(){
        return $this->belongsTo(kode_kantor::class,'kantor_id');
    }
}
