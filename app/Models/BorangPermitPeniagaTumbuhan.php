<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorangPermitPeniagaTumbuhan extends Model
{
    use HasFactory;
    protected $table = "borang_permit_peniaga_tumbuhan";
    public $primaryKey = "id";
}
