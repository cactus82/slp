<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalinanSijilKesihatan extends Model
{
    use HasFactory;
    protected $table = "salinan_sijil_kesihatan";
    public $primaryKey = "id";
}
