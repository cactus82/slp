<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SenaraiDibawaMasuk extends Model
{
    use HasFactory;
    protected $table = "senarai_dibawa_masuk";
    public $primaryKey = "id";
}
