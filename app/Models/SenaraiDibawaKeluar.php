<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SenaraiDibawaKeluar extends Model
{
    use HasFactory;
    protected $table = "senarai_dibawa_keluar";
    public $primaryKey = "id";
}
