<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mastersimpanan extends Model
{
    protected $table = 'mastersimpanan';
    protected $primarykey = "id";
    protected $fillable = [
        'id',
        'jenissimpanan',
    ];
}
