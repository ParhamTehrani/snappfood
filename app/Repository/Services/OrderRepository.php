<?php


namespace App\Repository\Services;


use App\Models\Order;
use App\Repository\Interfaces\OrderRepositoryInterface;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    protected $model;
    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function create($payload)
    {
        $model = $this->model->create($payload);
        // for clean code we can user observer or event too
        $model->food->ingredients()->decrement('stock');
        return $model->fresh();
    }
}
