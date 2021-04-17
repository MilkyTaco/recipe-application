<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    public $timestamps = true;

    public function ingredients()
    {
        return $this->hasMany(Ingredients::class, 'ingredients_id', 'id');
    }

    public function steps()
    {
        return $this->hasMany(Steps::class, 'steps_id', 'id');
    }
}
