<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalinanICPassport extends Model
{
    use HasFactory;
    protected $table = "salinan_ic_passport";
    public $primaryKey = "id";
}
