<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPerniagaanDaging extends Model
{
    use HasFactory;
    protected $table = "jenis_perniagaan_daging";
    public $primaryKey = "id";
}
