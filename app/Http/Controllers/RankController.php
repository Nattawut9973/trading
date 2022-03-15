<?php

namespace App\Http\Controllers;

use App\Event;
use App\Order;
use App\Product;
use App\ProductData;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RankController extends Controller
{
    public function ranking()
    {
        $events = Event::query()
            ->orderBy('created_at','desc')
            ->limit(5)
            ->get();
        $tops = User::query()
            ->where('amount_order', '>=', 5)
            ->orderBy('sum', 'desc')
            ->limit(5)
            ->get();
        $last = User::query()->where('amount_order', '>=', 5)
            ->orderBy('sum', 'asc')
            ->first();


        return view('frontend.ranking.index', compact('tops', 'last','events'));
    }

    public function selectRound(Request $request)
    {
        $event = $request->input('event_id');
        $tops = User::query()
            ->where('amount_order','>=',5)
            ->where('event_id','=',$event)
            ->orderBy('result','desc')
            ->limit(5)
            ->get();
        $last = User::query()
            ->where('id',$event)
            ->where('amount_order', '>=', 5)
            ->orderBy('sum', 'asc')
            ->first();
        $events = Event::query()->orderBy('created_at','desc')
            ->limit(5)
            ->get();

        return view('frontend.ranking.index', compact('tops','events','last'));
    }

    public function raw()
    {
        return view('frontend.ranking.raws');
    }

    public function userRanking()
    {
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
                } else {
                    User::query()->where('id', $user->id)->update(['sum' => $user->sum + $sum->price]);
                }
            }
        }
    }

    public function editPro()
    {
//        $now = Carbon::now();
//        $products = ProductData::query()->whereDate('created_at',$now)->update([
//            'created_at' => '2019-06-15 17:00:00',
//            'updated_at' => '2019-06-15 17:00:00'
//        ]);
//
    }
}
