<?php

namespace App\Http\Controllers\admin;

use App\AutoSell;
use App\Event;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Mail\AlertAutoSell;
use App\Mail\SendMailable;
use App\Order;
use App\Product;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 15;

        if (!empty($keyword)) {
            $order = Order::where('title', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orWhere('total_price', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $order = Order::latest()->paginate($perPage);
        }
        $page = (int)\request('page') ?: 1;

        return view('admin.order.index', compact('order', 'page', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $requestData = $request->all();

        Order::create($requestData);

        return redirect('admin/order')->with('flash_message', 'Order added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);

        return view('admin.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);

        return view('admin.order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        $order = Order::findOrFail($id);
        $order->update($requestData);

        return redirect('admin/order')->with('flash_message', 'Order updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Order::destroy($id);

        return redirect('admin/order')->with('flash_message', 'Order deleted!');
    }

    public function getProduct(Request $request)
    {
        $time = Carbon::now();
        $symbol = $request->input('product');
        $amount = $request->input('amount');
        if ($amount % 100 != 0) {
            Alert::error('ยกเลิก', 'จำนวนขั้นต่ำ 100 200 300 ...');
            return redirect()->back();
        }

        $product_id = Product::query()->where('symbol', $symbol)
            ->select('id')->first();
        $product = Product::query()->where('symbol', $symbol)
            ->select('offer')->first();
        $amount = (float)$amount;

        $price = (float)$product->offer * $amount;
        $com_fee = ($price * 0.15) / 100;
        $vat = ($com_fee * 7) / 100;
        $total_price = $price + $com_fee + $vat;

        return view('frontend.orders.get_products', compact('symbol', 'amount', 'product', 'total_price', 'time', 'product_id', 'com_fee', 'vat'));
    }

    public function selectProduct(Request $request)
    {
        $time = Carbon::now();
        $product_id = $request->input('product_id');
        $product = Product::query()
            ->where('id', $product_id)
            ->first();

        return view('frontend.orders.select_product', compact('product', 'time'));
    }

    public function getOrder(Request $request)
    {
        $now = Carbon::now();
        $event_id = auth()->user()->event_id;
        $ev = Event::query()->whereDate('start_date','<=',$now)
            ->whereDate('end_date','>=',$now)
            ->where('id',$event_id)
            ->get();

        if ($ev->isEmpty()){
            Alert::warning('ยกเลิก','ขณะนี้อยู่นอกเวลาการแข่งขัน');
            return redirect()->route('products');
        }
        $title = $request->input('symbol');
        $user_id = auth()->user()->id;
        $price = $request->input('total_price');
        $amount = $request->input('amount');
        $buy_price = $request->input('product');
        $time = $request->input('time');
        $get_result = auth()->user()->result;
        $product_id = $request->input('product_id');
        if ($get_result - $price < 0) {
            Alert::error('คำสั่งซื้อถูกยกเลิก', 'ยอดเงินคงเหลือไม่เพียงพอ');
            return redirect()->route('products');
        } else {
            $result = $get_result - $price;
            User::query()->where('id', $user_id)->update([
                'result' => $result,
                'amount_order' => auth()->user()->amount_order + 1
            ]);
            Order::create([
                'title' => $title,
                'user_id' => $user_id,
                'product_id' => $product_id,
                'status' => 'buy',
                'amount' => $amount,
                'price_per_unit' => $buy_price,
                'total_price' => $price,
                'created_at' => $time
            ]);
            Alert::success('สำเร็จ', 'ซื้อสำเร็จ');
            return redirect()->route('products');
        }
    }

    public function preSell(Request $request)
    {
        $now = Carbon::now();
        $order_id = $request->input('order_id');
        $price = $request->input('price');
        $amount = $request->input('amount');
        $order = Order::query()
            ->with('product')
            ->where('id', $order_id)
            ->get();
        $com = ((float)$price * 0.15) / 100;
        $vat = ($com * 7) / 100;
        $total_price = ($amount * $price) - $com - $vat;
        return view('frontend.orders.pre_sell', compact('order_id', 'order', 'now', 'com', 'vat', 'total_price', 'price'));
    }

    public function sell(Request $request)
    {
        $total = $request->input('total_price');
        $user = auth()->user()->id;
        $temp_result = auth()->user()->result;
        $price_per_unit = $request->input('price_per_unit');
        $order = $request->input('order_id');
        $item = Order::query()
            ->where('id', $order)
            ->first();
        $result = $temp_result + $total;
        $amount_order = auth()->user()->amount_order;
        $amount = $amount_order - 1;
        User::query()
            ->where('id', $user)
            ->update([
                'result' => $result,
                'amount_order' => $amount,
            ]);
        Order::create([
            'title' => $item->title,
            'user_id' => $item->user_id,
            'product_id' => $item->product_id,
            'status' => 'sell',
            'amount' => $item->amount,
            'price_per_unit' => $price_per_unit,
            'total_price' => $price_per_unit * $item->amount,
        ]);
        Order::query()
            ->where('id', $order)
            ->delete();
        Alert::success('สำเร็จ', 'ขายสำเร็จ');
        return redirect()->route('port');
    }

    public function autoSale(Order $order)
    {
        $now = Carbon::now();
        $product = Product::query()
            ->where('id', '=', $order->product_id)->first();

        return view('frontend.orders.auto_sale', compact('order', 'product', 'now'));
    }

    public function sale(Request $request, Order $order)
    {
        $lower_price = $request->input('lower_price');
        $higher_price = $request->input('higher_price');

        if (!empty($lower_price)) {
            AutoSell::create([
                'user_id' => auth()->user()->id,
                'order_id' => $order->id,
                'lower_price' => $lower_price,
            ]);
        }
        if (!empty($higher_price)){
            AutoSell::create([
                'user_id' => auth()->user()->id,
                'order_id' => $order->id,
                'higher_price' => $higher_price,
            ]);
        }
        Alert::success('สำเร็จ', 'ส่งคำขอการขายอัตโนมัติสำเร็จ');
        return redirect()->route('port');
    }
}
