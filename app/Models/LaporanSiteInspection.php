<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanSiteInspection extends Model
{
    use HasFactory;
    protected $table = "laporan_site_inspection";
    public $primaryKey = "id";
}
