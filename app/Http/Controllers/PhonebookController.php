<?php

namespace App\Http\Controllers;

use App\Country;
use App\Email;
use App\Phone;
use App\User;
use Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PhonebookController extends Controller
{
    /**
     * Display a listing of the phonebook
     *
     * @return Factory|View
     */
    public function index()
    {
        $users = User::whereNotNull('firstname')->whereNotNull('lastname')->get();

        return view('phonebook.index', ['users' => $users]);
    }

    public function show($id)
    {
        $user = User::find($id);
        $phones = $user->phones;
        $emails = $user->emails;

        return view('phonebook.show', [
            'user' => $user,
            'phones' => $phones,
            'emails' => $emails
        ]);
    }

    public function mycontact()
    {
        $currentUser = Auth::user()->id;
        $user = User::find($currentUser);
        $countries = Country::all()->pluck('name');

        return view('phonebook.mycontact', ['user' => $user, 'countries' => $countries]);
    }

    public function store(Request $request)
    {
        if (!$request->exists('status')) {
            $request;
        }
        return $request;
    }
}
