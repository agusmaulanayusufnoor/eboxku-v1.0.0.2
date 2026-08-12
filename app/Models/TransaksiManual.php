<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiManual extends Model
{
    use HasFactory;

    protected $table = 'transaksi_manual';

    protected $fillable = [
        'kantor_id',
        'nama_file',
        'tanggal',
        'status',
    ];

    public function kantor()
    {
        return $this->belongsTo(kode_kantor::class, 'kantor_id');
    }

    public function details()
    {
        return $this->hasMany(TransaksiManualDetail::class, 'transaksi_manual_id');
    }
}
