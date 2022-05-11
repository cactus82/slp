<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisDibawaKeluar extends Model
{
    use HasFactory;
    protected $table = "jenis_dibawa_keluar";
    public $primaryKey = "id";
}
