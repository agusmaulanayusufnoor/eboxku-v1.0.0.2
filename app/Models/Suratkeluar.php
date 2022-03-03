<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suratkeluar extends Model
{
    protected $table = 'suratkeluar';
    protected $primarykey = "id";
    protected $fillable = [
        'id',
        'kantor_id',
        'no_surat',
        'tanggal',
        'namafile',
        'file',
    ];
    public function kantor(){
        return $this->belongsTo(kode_kantor::class,'kantor_id');
    }
}
