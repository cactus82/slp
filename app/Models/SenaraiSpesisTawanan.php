<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SenaraiSpesisTawanan extends Model
{
    use HasFactory;
    protected $table = "senarai_spesis_tawanan";
    public $primaryKey = "id";
}
