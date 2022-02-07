<?php

namespace App\Repository\Interfaces;

interface FoodRepositoryInterface extends BaseRepositoryInterface
{
    public function getAvailableFoods();

    public function checkIsUnAvailable($id);

}
