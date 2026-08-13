<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepuasanCs extends Model
{
    use HasFactory;

    protected $table = 'kepuasan_cs';

    protected $fillable = [
        'user_id',
        'kantor_id',
        'tanggal',
        'puas',
        'tidak_puas',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kantor()
    {
        return $this->belongsTo(Kode_kantor::class, 'kantor_id');
    }
}
