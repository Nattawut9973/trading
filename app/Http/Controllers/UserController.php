<?php

namespace App\Http\Controllers;

use App\Event;
use App\Mail\SendMailable;
use App\Notifications\SendEmail;
use App\Order;
use App\ProductData;
use App\User;
use App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\ImageManagerStatic;
use RealRashid\SweetAlert\Facades\Alert;
use Image;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 15;
        if (!empty($keyword)) {
            $users = User::where('id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('round', 'LIKE', "%$keyword%")
                ->orWhere('lastname', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('tel', 'LIKE', "%$keyword%")
                ->orWhere('created_at', 'LIKE', "%$keyword%")
                ->orWhere('result', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $users = User::latest()->paginate($perPage);
        }
        $page = (int)\request('page') ?: 1;
        return view('admin.users.list', compact('users', 'perPage', 'page'));
    }

    public function showCreateForm()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $name = $request->input('name');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $age = $request->input('age');
        $password = $request->input('password');
        $tel = $request->input('tel');

        User::create([
            'name' => $name,
            'lastname' => $lastname,
            'email' => $email,
            'password' => Hash::make($password),
            'age' => $age,
            'tel' => $tel
        ]);

        return redirect(url('admin/home'))->with('success', 'create successful');
    }

    public function editProfile()
    {
        return view('frontend.users.edit_profile');
    }

    public function updateProfile(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $lastname = $request->input('lastname');
        $age = $request->input('age');
        $tel = $request->input('tel');

        User::query()->where('id', $id)->update([
            'name' => $name,
            'lastname' => $lastname,
            'age' => $age,
            'tel' => $tel
        ]);
        Alert::success('แก้ไขสำเร็จ', 'profile update success');
        return redirect()->route('profile');
    }

    public function roundUser()
    {
        $now = Carbon::now();
        $event = Event::query()->where('end_date', '<=', $now)->first();
        $users = User::query()
            ->Where('event_id', $event->id)->get();

        foreach ($users as $user) {
            $user->reviveExpired();
        }

        Alert::success('User update success', 'Success Message');
        return redirect()->route('index');
    }

    public function history()
    {
        $user_event = auth()->user()->event_id;
        $event = Event::query()
            ->where('id', '=', $user_event)
            ->first();

        $ranks = User::query()
            ->where('amount_order', '>=', 5)
            ->orderBy('sum', 'desc')
            ->get();

        $user = auth()->user()->id;
        $orders = Order::query()
            ->with('product')
            ->where('user_id', $user)
            ->where('status', 'buy')
            ->orWhere('status','=','sell')
            ->orderBy('created_at', 'desc')
            ->get();
        if (empty($orders)) {
            $total = 0;
        }
        $total = Order::query()->where('user_id', $user)
            ->where('status', '=', 'buy')
            ->groupBy('user_id')
            ->select(['user_id', DB::raw('sum(total_price) as total_price')])
            ->first();

        $order_products = Order::query()
            ->with('product')
            ->where('user_id', $user)
            ->orderBy('product_id', 'desc')
            ->groupBy('product_id')
            ->select(['product_id', DB::raw('sum(amount) as amount')])
            ->get();

        return view('frontend.orders.viewport', compact('orders', 'total', 'order_products', 'event', 'ranks'), array('user' => Auth::user()));
    }

    public function updateImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            ImageManagerStatic::make($image)->resize(300, 300)->save(public_path('uploads/users/profile/' . $filename));
            $user = Auth::user();
            $user->image = $filename;
            $user->save();

            return redirect()->route('profile', array('user' => Auth::user()));
        }

    }


    public function mail()
    {
        $name = auth()->user()->name;
        Mail::to(auth()->user()->email)->send(new SendMailable($name));
    }

    public function port()
    {
        $user = auth()->user()->id;
        $orders = Order::query()
            ->with('product')
            ->where('user_id', $user)
            ->where('status', 'buy')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('frontend.users.port', compact('orders'));
    }

}
