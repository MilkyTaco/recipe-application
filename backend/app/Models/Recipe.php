<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function ingredients()
    {
        return $this->hasMany(Ingredients::class, 'id', 'recipe_id');
    }

    public function steps()
    {
        return $this->hasMany(Steps::class, 'id', 'recipe_id');
    }

    public function categories()
    {
        return $this->hasMany(Categories::class, 'id', 'recipe_id');
    }
}
