<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreOrderRequest;
use App\Models\Food;
use App\Models\Order;
use App\Repository\Interfaces\FoodRepositoryInterface;
use App\Repository\Interfaces\OrderRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(StoreOrderRequest $request, FoodRepositoryInterface $foodRepository, OrderRepositoryInterface $orderRepository)
    {
        $validatedData = $request->validated();
        $isUnAvailable = $foodRepository->checkIsUnAvailable($validatedData['food_id']);
        if ($isUnAvailable) {
            return response()->json([
                'status' => false,
                'message' => 'غیر قابل سفارش'
            ], 404);
        } else {
            $orderRepository->create([
                'food_id' => $validatedData['food_id']
            ]);
            return response()->json([
                'status' => true
            ], 201);
        }

    }
}
