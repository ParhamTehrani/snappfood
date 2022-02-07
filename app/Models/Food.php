<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Food extends Model
{
    use SoftDeletes;
    protected $fillable = ['title'];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class)->select('ingredients.id','ingredients.title','ingredients.stock');
    }
}
