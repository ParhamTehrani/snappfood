<?php


namespace App\Repository\Services;


use App\Models\Food;
use App\Repository\Interfaces\FoodRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FoodRepository extends BaseRepository implements FoodRepositoryInterface
{
    protected $model;
    public function __construct(Food $model)
    {
        parent::__construct($model);
    }

    public function getAvailableFoods()
    {
        return $this->model->select([
            'food.id as food_id',
            'food.title as food_title',
            DB::raw('MIN(ingredients.best_before) as min_best_before')
        ])
            ->join('food_ingredient','food.id','food_ingredient.food_id')
            ->join('ingredients','ingredients.id','food_ingredient.ingredient_id')
            ->havingRaw('MIN(ingredients.stock) > 0')
            ->havingRaw('MIN(ingredients.expires_at) > NOW()')
            ->groupBy('food_id')
            ->orderBy('min_best_before','DESC')
            ->get();
    }

    public function checkIsUnAvailable($id)
    {
        $food = $this->findById($id);
        return $food->ingredients()->whereDate('expires_at', '<' , Carbon::now())->orWhere('stock','<',1)->exists();
    }

}
