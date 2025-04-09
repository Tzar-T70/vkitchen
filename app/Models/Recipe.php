<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $primaryKey = "rid";
    protected $table = 'recipes';

    // Either use fillable or guarded (but not both)
    protected $fillable = [
        'rid',
        'name',
        'description',
        'type',
        'cookingtime',
        'ingredients',
        'instructions',
        'image',
        'uid'
    ];

    // Casting for specific fields
    protected $casts = [
        'cookingtime' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'uid');
    }
}
