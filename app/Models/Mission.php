<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $fillable = ['intitule','decripion','debut','fin','fonction','remuneration','desc_rem','qualification'];
    use HasFactory;
}
