<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ContactController extends Controller
{
    public function getMessage(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $message = $request->input('message');

        Contact::create([
            'name' => $name,
            'email' => $email,
            'message' => $message
        ]);
        Alert::success('Send Success', 'Waiting for contact from administrator');
        return redirect()->back();
    }

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 15;

        if (!empty($keyword)) {
            $contacts = Contact::where('name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('message', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $contacts = Contact::latest()->paginate($perPage);
        }
        $page = (int)\request('page') ?: 1;

        return view('admin.contacts.index', compact('contacts', 'page', 'perPage'));
    }
}
