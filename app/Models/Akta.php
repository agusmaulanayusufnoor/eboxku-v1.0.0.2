<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Akta extends Model
{
    protected $table = 'akta';
    protected $primarykey = "id";
    protected $fillable = [
        'id',
        'kantor_id',
        'no_akta',
        'tanggal',
        'namafile',
        'file',
    ];
    public function kantor(){
        return $this->belongsTo(kode_kantor::class,'kantor_id');
    }
}
