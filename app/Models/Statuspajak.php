<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statuspajak extends Model
{
    protected $table = 'status_pajak';
    protected $primarykey = "id";
    protected $fillable = [
        'id',
        'statuspajak',
    ];
}
