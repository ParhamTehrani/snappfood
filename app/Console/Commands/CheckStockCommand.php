<?php

namespace App\Console\Commands;

use App\Models\Ingredient;
use Illuminate\Console\Command;

class CheckStockCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:stock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'checking the stock';

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
        $ingredient = Ingredient::where('stock', '<' ,1)->increment('stock',4);
    }
}
