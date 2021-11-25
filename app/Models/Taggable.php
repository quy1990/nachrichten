<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taggable extends Model
{
    use HasFactory;

    protected $primaryKey = null;

    public bool $incrementing = false;

    public bool $timestamps = false;
}
