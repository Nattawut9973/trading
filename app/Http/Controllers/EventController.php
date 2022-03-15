<?php

namespace App\Http\Controllers;

use App\Event;
use App\Mail\UserExpire;
use App\ProductData;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;


class EventController extends Controller
{
    public function showEventForm(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 15;
        if (!empty($keyword)) {
            $events = Event::query()->where('id', 'LIKE', "%$keyword%")
                ->orWhere('title', 'LIKE', "%$keyword%")
                ->orWhere('start_date', 'LIKE', "%$keyword%")
                ->orWhere('end_date', 'LIKE', "%$keyword%")
                ->orWhere('price', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $events = Event::query()->latest()->paginate($perPage);
        }
        $page = (int)\request('page') ?: 1;

        return view('admin.events.index', compact('events', 'perPage', 'page'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $title = $request->input('title');
        $start = $request->input('start_date');
        $end = $request->input('end_date');
        $price = $request->input('price');

        if (!empty($start) && !empty($end)) {
            Event::create([
                'title' => $title,
                'start_date' => $start,
                'end_date' => $end,
                'price' => $price
            ]);
            return redirect()->route('events');
        }
    }
}
