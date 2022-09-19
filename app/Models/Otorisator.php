<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otorisator extends Model
{
    protected $table = 'otorisator';
    protected $primarykey = "id";
    protected $fillable = [
        'id',
        'namaotorisator',
    ];
}
