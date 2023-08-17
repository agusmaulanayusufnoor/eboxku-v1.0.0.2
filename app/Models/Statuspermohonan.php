<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statuspermohonan extends Model
{
    protected $table = 'statuspermohonan';
    protected $primarykey = "id";
    protected $fillable = [
        'id',
        'statuspermohonan',
    ];
}
