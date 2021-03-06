<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredients extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $hidden = [
        'recipe_id',
    ];
    protected $fillable = [
        'name',
        'amount',
        'measuring_instrument'
    ];
    public function recipe()
    {
        return $this->belongsTo(Recipe::class, 'id', 'recipe_id');
    }
}
