<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cs extends Model
{
    protected $table = 'cs';
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
