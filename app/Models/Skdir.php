<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skdir extends Model
{
    protected $table = 'skdir';
    protected $primarykey = "id";
    protected $fillable = [
        'id',
        'kantor_id',
        'no_sk',
        'tanggal',
        'namafile',
        'file',
    ];
    public function kantor(){
        return $this->belongsTo(kode_kantor::class,'kantor_id');
    }
}
