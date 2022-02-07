<?php

namespace App\Console\Commands;

use App\Models\Food;
use App\Models\Ingredient;
use Illuminate\Console\Command;

class AddDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adding data from json files';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $ingredients = json_decode(file_get_contents(public_path('/ingredients.json'),true));
        $ingredientsData = [];
        foreach ($ingredients->ingredients as $ingredient){
            $ingredientsData[] = [
                'title' => get_object_vars($ingredient)['title'],
                'stock' => get_object_vars($ingredient)['stock'],
                'expires_at' => get_object_vars($ingredient)['expires-at'],
                'best_before' => get_object_vars($ingredient)['best-before'],
            ];
        }
        Ingredient::insert($ingredientsData);

        $foods = json_decode(file_get_contents(public_path('/foods.json'),true));
        foreach ($foods->recipes as $food){
            $foodInstance = Food::create([
                'title' => get_object_vars($food)['title']
            ]);

            $ingredientTitles = get_object_vars($food)['ingredients'];
            $ingredientIds = Ingredient::whereIn('title',$ingredientTitles)->get()->pluck('id');
            $foodInstance->ingredients()->sync($ingredientIds);
        }

    }
}
