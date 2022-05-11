<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorangPermitBawaKeluar extends Model
{
    use HasFactory;
    protected $table = "borang_permit_bawa_keluar";
    public $primaryKey = "id";
}
