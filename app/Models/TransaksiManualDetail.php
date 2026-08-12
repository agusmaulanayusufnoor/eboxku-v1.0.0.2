<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiManualDetail extends Model
{
    use HasFactory;

    protected $table = 'transaksi_manual_details';

    protected $fillable = [
        'transaksi_manual_id',
        'no_rekening',
        'nama_nasabah',
        'pokok',
        'bunga',
        'denda',
    ];

    public function transaksiManual()
    {
        return $this->belongsTo(TransaksiManual::class, 'transaksi_manual_id');
    }
}
