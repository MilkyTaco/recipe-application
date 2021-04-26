<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    public function recipe()
    {
        return $this->hasMany(Recipe::class, 'id', 'category_id');
    }
}
