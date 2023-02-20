<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memoumum extends Model
{
    protected $table = 'memoumum';
    protected $primarykey = "id";
    protected $fillable = [
        'id',
        'kantor_id',
        'no_memo',
        'jenis',
        'tanggal',
        'namafile',
        'file',
    ];
    public function kantor(){
        return $this->belongsTo(kode_kantor::class,'kantor_id');
    }
}
