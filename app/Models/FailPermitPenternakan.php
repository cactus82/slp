<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailPermitPenternakan extends Model
{
    use HasFactory;

    protected $table = "fail_permit_penternakan";
    public $primaryKey = "id";
}
