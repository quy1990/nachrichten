<?php

namespace Modules\Menu\Entities;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Menu\Database\factories\MenuFactory;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'route', 'icon'];

    protected static function newFactory(): Factory
    {
        return MenuFactory::new();
    }
}
