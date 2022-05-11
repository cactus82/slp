<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorangPermitPenternakan extends Model
{
    use HasFactory;
    protected $table = "borang_permit_penternakan";
    public $primaryKey = "id";
}
