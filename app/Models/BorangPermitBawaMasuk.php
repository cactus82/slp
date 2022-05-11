<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorangPermitBawaMasuk extends Model
{
    use HasFactory;
    protected $table = "borang_permit_bawa_masuk";
    public $primaryKey = "id";
}
