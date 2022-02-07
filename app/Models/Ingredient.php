<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredient extends Model
{
    use SoftDeletes;
    protected $fillable = ['title','best-before','expires-at','stock'];


    public function foods()
    {
        return $this->belongsToMany(Food::class);
    }
}
