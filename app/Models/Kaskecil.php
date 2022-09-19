<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kaskecil extends Model
{
    protected $table = 'kaskecil';
    protected $primarykey = "id";
    protected $fillable = [
        'id',
        'kantor_id',
        'namafile',
        'tanggal',
        'otorisator_id',
        'file',
    ];
    public function kantor(){
        return $this->belongsTo(kode_kantor::class,'kantor_id');
    }
}
