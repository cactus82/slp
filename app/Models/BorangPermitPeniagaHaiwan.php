<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorangPermitPeniagaHaiwan extends Model
{
    use HasFactory;
    protected $table = "borang_permit_peniaga_haiwan";
    public $primaryKey = "id";
}
