<?php

namespace Modules\Role\Entities;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Role\Database\factories\RoleFactory;
use Modules\User\Entities\User;

class Role extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name'];

    protected static function newFactory(): Factory
    {
        return RoleFactory::new();
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
