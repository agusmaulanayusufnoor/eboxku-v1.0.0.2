<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pjkpph4ayat2 extends Model
{
    protected $table = 'pjkpph4ayat2';
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
