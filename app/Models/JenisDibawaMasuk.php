<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisDibawaMasuk extends Model
{
    use HasFactory;
    protected $table = "jenis_dibawa_masuk";
    public $primaryKey = "id";
}
