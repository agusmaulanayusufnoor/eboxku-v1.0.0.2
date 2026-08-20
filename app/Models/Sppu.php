<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sppu extends Model
{
    protected $table = 'sppu';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kantor_id',
        'user_id',
        'penerima_uang',
        'nominal',
        'keterangan',
    ];

    public function kantor()
    {
        return $this->belongsTo(Kode_kantor::class, 'kantor_id');
    }
}
