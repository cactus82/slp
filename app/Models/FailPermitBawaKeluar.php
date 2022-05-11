<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailPermitBawaKeluar extends Model
{
    use HasFactory;
    protected $table = "fail_permit_bawa_keluar";
    public $primaryKey = "id";
}
