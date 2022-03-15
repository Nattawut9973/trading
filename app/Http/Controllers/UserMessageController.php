<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductData;
use App\User;
use App\UserMessage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserMessageController extends Controller
{
    public function index(Request $request)
    {
        $product_id = $request->input('product_id');
        $user_id = $request->input('user_id');

        $product = Product::query()
            ->where('id', $product_id)
            ->first();
        $datas = ProductData::query()->where('product_id', '=', $product->id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        $text = ProductData::query()->where('product_id', $product_id)
            ->get(['created_at','price'])
            ->toJson();

        return view('frontend.users.select_message', compact('product', 'user_id', 'product_id', 'datas','text'));
    }

    public function sendRequest(Request $request)
    {
        $status = $request->input('value');
        $data = $request->input('price');
        $lower = $request->input('lower_price');
        $higher = $request->input('higher_price');
        $product_id = $request->input('product_id');
        $user_id = auth()->user()->id;
        if (auth()->check() && !empty($status)) {
            if (!empty($data)) {
                UserMessage::create([
                    'user_id' => $user_id,
                    'product_id' => $product_id,
                    'value' => $data,
                    'status' => $status,
                    'notify' => false
                ]);
            } elseif (!empty($higher) && !empty($lower)) {
                UserMessage::create([
                    'user_id' => $user_id,
                    'product_id' => $product_id,
                    'lower' => $lower,
                    'higher' => $higher,
                    'status' => $status,
                    'notify' => false
                ]);
            } else {
                Alert::error('Error', 'กรุณาใส่ราคาที่ต้องการ');
                return back();
            }
            Alert::success('Success', 'เพิ่มการติดตามเรียบร้อยแล้ว');
            return redirect()->back();
        } else {
            Alert::error('Error', 'กรุณาเลือกเงื่อนไชการแจ้งเตือน');
            return back();
        }
    }

}

