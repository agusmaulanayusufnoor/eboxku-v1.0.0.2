<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotaPemindahbukuan extends Model
{
    protected $table = 'nota_pemindahbukuan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kantor_id',
        'user_id',
        'jenis_transaksi',
        'nominal',
        'keterangan',
    ];

    public function kantor()
    {
        return $this->belongsTo(Kode_kantor::class, 'kantor_id');
    }
}
