<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statuspegawai extends Model
{
    protected $table = 'status_pegawai';
    protected $primarykey = "id";
    protected $fillable = [
        'id',
        'statuspegawai',
    ];
}
