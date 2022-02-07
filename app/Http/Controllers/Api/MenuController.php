<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\FoodListResource;
use App\Models\Food;
use App\Repository\Interfaces\FoodRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index(FoodRepositoryInterface $foodRepository)
    {

        $menu = $foodRepository->getAvailableFoods();

        if ($menu->count()){
            return response()->json([
                'success' => true,
                'data' => FoodListResource::collection($menu)
            ],200);
        }else{
            return response()->json([
                'status'=>false,
                'message' => 'no data'
            ],404);
        }


    }
}
