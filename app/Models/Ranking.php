<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    protected $fillable = ['full_name', 'rank', 'hours', 'date_rank'];
}
