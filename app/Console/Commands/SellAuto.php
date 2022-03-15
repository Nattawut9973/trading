<?php

namespace App\Console\Commands;

use App\AutoSell;
use App\Mail\AlertAutoSell;
use App\Order;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SellAuto extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sell:auto';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatic sell item price at collect';

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
        $orders = Order::query()
            ->where('status', '=', 'buy')
            ->with('product')
            ->with('users')
            ->get();
        foreach ($orders as $order) {

            $a = AutoSell::query()
                ->where('order_id', $order->id)
                ->where('lower_price', '!=', null)
                ->where('lower_price', '>=', $order->product->offer)
                ->first();

            if (!empty($a)) {
                $user_id = $a->user_id;
                $amount = $order->amount;
                $lower_price = $a->lower_price;
                $user_query = User::query()->where('id', '=', $order->user_id)
                    ->first();
                $mail = $user_query->email;
                $user_name = $user_query->name;

                Order::create([
                    'title' => $order->title,
                    'user_id' => $user_id,
                    'product_id' => $order->product_id,
                    'status' => 'sell',
                    'amount' => $amount,
                    'price_per_unit' => $lower_price,
                    'total_price' => $amount * $lower_price,
                ]);
                User::query()
                    ->where('id', $order->user_id)
                    ->update([
                        'result' => $user_query->result + ($lower_price * $amount),
                        'amount_order' => $user_query->amount_order - 1,
                    ]);
                Mail::to($mail)->send(new AlertAutoSell($user_name));

                Order::query()->where('id', $order->id)->delete();
                AutoSell::query()->where('order_id', $order->id)->delete();
            }

            $b = AutoSell::query()
                ->where('order_id', $order->id)
                ->where('higher_price', '!=', null)
                ->where('higher_price', '<=', $order->product->offer)
                ->first();

            if (!empty($b)) {
                $user_id = $b->user_id;
                $amount = $order->amount;
                $higher_price = $b->higher_price;
                $user_query = User::query()->where('id', '=', $order->user_id)
                    ->first();
                $mail = $user_query->email;
                $user_name = $user_query->name;

                Order::create([
                    'title' => $order->title,
                    'user_id' => $user_id,
                    'product_id' => $order->product_id,
                    'status' => 'sell',
                    'amount' => $amount,
                    'price_per_unit' => $higher_price,
                    'total_price' => $amount * $higher_price,
                ]);
                User::query()
                    ->where('id', $order->user_id)
                    ->update([
                        'result' => $user_query->result + ($higher_price * $amount),
                        'amount_order' => $user_query->amount_order - 1,
                    ]);
                Order::query()->where('id', $order->id)
                    ->delete();
                Mail::to($mail)->send(new AlertAutoSell($user_name));
                AutoSell::query()->where('order_id', $order->id)->delete();
            }
        }
    }
}
