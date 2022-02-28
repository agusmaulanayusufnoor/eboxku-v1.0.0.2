<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rekkoranaba extends Model
{
    protected $table = 'rekkoranaba';
    protected $primarykey = "id";
    protected $fillable = [
        'id',
        'kantor_id',
        'no_rekening',
        'tanggal',
        'namafile',
        'file',
    ];
    public function kantor(){
        return $this->belongsTo(kode_kantor::class,'kantor_id');
    }
}
