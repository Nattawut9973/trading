<?php

namespace App\Console\Commands;

use App\Order;
use App\Product;
use App\ProductData;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SaveData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:savedata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'save product price in everyday';

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
     * @return mixed
     */
    public function handle()
    {
        $products = Product::all();
        foreach ($products as $product) {
            ProductData::create([
                'product_id' => $product->id,
                'price' => $product->last
            ]);
        }
        $sums = Order::query()
            ->where('status', '=', 'buy')
            ->where('check', '=', 'uncheck')
            ->with('users')
            ->leftJoin('products', 'product_id', '=', 'products.id')
            ->select(['user_id', DB::raw('amount * bid as price')])
            ->get();
        if ($sums != null) {
            foreach ($sums as $sum) {
                $user = User::query()->where('id', $sum->users->id)
                    ->first();
                Order::query()->where('user_id', $sum->user_id)->update(['check' => 'checked']);
                if ($user->sum == null) {
                    User::query()->where('id', $user->id)->update(['sum' => $user->result + $sum->price]);
                }else{
                    User::query()->where('id',$user->id)->update(['sum' => $user->sum + $sum->price]);
                }
            }
        }
    }
}
