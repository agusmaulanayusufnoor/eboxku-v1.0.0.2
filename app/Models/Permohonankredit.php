<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permohonankredit extends Model
{
    protected $table = 'permohonankredit';
    protected $primarykey = "id";
    protected $fillable = [
        'id',
        'kantor_id',
        'no_ktp',
        'no_rekening',
        'namafile',
        'tgl_permohonan',
        'tgl_setujutolak',
        'tgl_pencairan',
        'jml_permohonan',
        'jml_realisasi',
        'file',
        'file_disetujui',
        'file_spk',
        'status_id',
    ];
    protected $fromtgl = ['fromtgl'];
    protected $totgl = ['totgl'];
    public function kantor(){
        return $this->belongsTo(kode_kantor::class,'kantor_id');
    }
    public function status(){
        return $this->belongsTo(statuspermohonan::class,'status_id');
    }

    public function getTanggalAttribute(){
        // return $this->attributes['tanggal'] = ($value);
         return date('d/m/Y', strtotime($this->attributes['tanggal']));
     }
}
