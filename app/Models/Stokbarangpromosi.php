<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stokbarangpromosi extends Model
{
    protected $table = "stokbarangpromosi";
    protected $fillable = [
        'id',
        'kantor_id',
        'periode',
        'barang_id',
        'satuan_id',
        'harga_satuan',
        'stok_awal',
        'stok_masuk',
        'stok_keluar',
        'stok_akhir',
        'nom_awal',
        'nom_masuk',
        'nom_keluar',
        'nom_akhir',
        'keterangan',
    ];
    //protected $guarded = [];
    protected $fromtgl = ['fromtgl'];
    protected $totgl = ['totgl'];


    public function kantor(){
        return $this->belongsTo(kode_kantor::class,'kantor_id');
    }
    public function barang(){
        return $this->belongsTo(barang::class,'barang_id');
    }
    public function satuan(){
        return $this->belongsTo(satuan::class,'satuan_id');
    }

    public function getTanggalAttribute(){
       // return $this->attributes['tanggal'] = ($value);
        return date('d/m/Y', strtotime($this->attributes['tanggal']));
    } 
}
