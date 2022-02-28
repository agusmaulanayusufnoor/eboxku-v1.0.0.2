<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Sedir extends Model
{
    protected $table = 'sedir';
    protected $primarykey = "id";
    protected $fillable = [
        'id',
        'kantor_id',
        'no_se',
        'tanggal',
        'namafile',
        'file',
    ];
    public function kantor(){
        return $this->belongsTo(kode_kantor::class,'kantor_id');
    }
}
