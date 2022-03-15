<?php

namespace App\Console\Commands;

use App\AutoSell;
use App\Mail\AlertAutoSell;
use App\Mail\SendMailable;
use App\Order;
use App\Product;
use App\User;
use App\UserMessage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notification to user email for item is activated';

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
            UserMessage::query()->with('products')
                ->where('product_id', '=', $product->id)
                ->where('status', '=', 'sale')
                ->where('value', '<=', $product->offer)
                ->update(['notify' => 1]);
            UserMessage::query()->with('products')
                ->where('product_id', $product->id)
                ->where('status', '=', 'buy')
                ->where('value', '>=', $product->offer)
                ->update(['notify' => 1]);
            UserMessage::query()->with('products')
                ->where('product_id', '=', $product->id)
                ->where('status', '=', 'both')
                ->where('lower', '>=', $product->offer)
                ->orWhere('higher', '<=', $product->offer)
                ->update(['notify' => 1]);
        }

        $datas = UserMessage::query()
            ->where('notify', '=', '1')->with('products')
            ->get();

        if (!empty($datas)) {
            foreach ($datas as $data) {
                $user = User::query()->where('id', $data->user_id)
                    ->first();
                if (!empty($user)) {
                    $sended = $data->id;
                    Mail::to($user->email)->send(new SendMailable($user->name));
                    UserMessage::query()
                        ->where('id', $sended)
                        ->delete();
                }
            }
        }
    }
}
