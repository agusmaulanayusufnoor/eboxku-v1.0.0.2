<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = "stock";
    protected $fillable = [
        'jenis',
        'kantor_id',
        'tanggal',
        'jml_stok_awal',
        'tambahan_stok',
        'jml_digunakan',
        'jml_rusak',
        'jml_hilang',
        'jml_stok_akhir'
    ];
    //protected $guarded = [];
    //protected $date = ['tanggal'];


    public function kantor(){
        return $this->belongsTo(kode_kantor::class,'kantor_id');
    }
    public function jenisstok(){
        return $this->belongsTo(stock_jenis::class,'jenis');
    }

    public function getTanggalAttribute(){
       // return $this->attributes['tanggal'] = ($value);
        return date('d/m/Y', strtotime($this->attributes['tanggal']));
    }
}
