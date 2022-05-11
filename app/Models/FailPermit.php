<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailPermit extends Model
{
    use HasFactory;
    protected $table = "fail_permit";
    public $primaryKey = "id";
}
