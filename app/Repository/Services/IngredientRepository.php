<?php


namespace App\Repository\Services;


use App\Models\Ingredient;
use App\Repository\Interfaces\IngredientRepositoryInterface;

class IngredientRepository extends BaseRepository implements IngredientRepositoryInterface
{
    protected $model;
    public function __construct(Ingredient $model)
    {
        $this->model = $model;
    }
}
