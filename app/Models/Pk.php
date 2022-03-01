<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Pk extends Model
{
    protected $table = 'pk';
    protected $primarykey = "id";
    protected $fillable = [
        'id',
        'kantor_id',
        'no_pk',
        'tanggal',
        'namafile',
        'file',
    ];
    public function kantor(){
        return $this->belongsTo(kode_kantor::class,'kantor_id');
    }
}
