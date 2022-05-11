<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusBorang extends Model
{
    use HasFactory;

    protected $table = "status_borang";
    public $primaryKey = "id";
}
