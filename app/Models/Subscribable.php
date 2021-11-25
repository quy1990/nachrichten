<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribable extends Model
{
    use HasFactory;

    public bool $timestamps = false;

    protected $primaryKey = null;

    public bool $incrementing = false;

    protected array $fillable = ['user_id', 'subscribable_id', 'subscribable_type'];
}
