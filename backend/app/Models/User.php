<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function recipe()
    {
        return $this->hasMany(Recipe::class, 'id', 'user_id');
    }

    public function bookmark()
    {
        return $this->hasMany(Bookmark::class, 'id', 'user_id');
    }
}
