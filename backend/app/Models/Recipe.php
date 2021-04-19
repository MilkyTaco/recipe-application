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
        return $this->hasMany(Ingredients::class, 'recipe_id', 'id');
    }

    public function procedures()
    {
        return $this->hasMany(Procedures::class, 'recipe_id', 'id');
    }

    public function categories()
    {
        return $this->hasMany(Categories::class, 'recipe_id', 'id');
    }
}
