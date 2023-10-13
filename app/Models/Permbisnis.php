<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permbisnis extends Model
{
    protected $table = 'permbisnis';
    protected $primarykey = "id";
    protected $fillable = [
        'id',
        'kantor_id',
        'namafile',
        'tgl_permohonan',
        'tgl_setujutolak',
        'tgl_acc',
        'tgl_selesai',
        'file',
        'file_memo',
        'status_id',
    ];
    public function kantor(){
        return $this->belongsTo(kode_kantor::class,'kantor_id');
    }
    public function status(){
        return $this->belongsTo(statuspermohonan::class,'status_id');
    }
}
