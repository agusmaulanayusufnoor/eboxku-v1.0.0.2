<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lapkap extends Model
{
    protected $table = 'lapkap';
    protected $primarykey = "id";
    protected $fillable = [
        'id',
        'kantor_id',
        'namafile',
        'tanggal',
        'file',
    ];
    public function kantor(){
        return $this->belongsTo(kode_kantor::class,'kantor_id');
    }
}
