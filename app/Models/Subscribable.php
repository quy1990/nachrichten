<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribable extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['user_id', 'subscribable_id', 'subscribable_type'];
}
