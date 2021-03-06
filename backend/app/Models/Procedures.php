<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procedures extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $hidden = [
        'recipe_id',
    ];
    protected $fillable = [
        'description',
        'step_count',
        'duration'
    ];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class, 'id', 'recipe_id');
    }
}
