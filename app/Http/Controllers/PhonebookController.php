<?php

namespace App\Http\Controllers;

use App\Contact;
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
        $contacts = Contact::whereNotNull('firstname')->whereNotNull('lastname')->get();

        return view('phonebook.index', ['contacts' => $contacts]);
    }

    public function show($id)
    {
        $user = User::find($id);

        return view('phonebook.show', [
            'user' => $user,
            'phones' => $user->contact->phones,
            'emails' => $user->contact->emails,
            'address' => $user->contact->address,
            'zipcode' => $user->contact->zipcode,
            'country' => $user->contact->country->country_name
        ]);
    }

    public function mycontact()
    {
        $user = Auth::user();
        ($user->country) ? $userCountry =  $user->country->name : $userCountry = null;

        $countries = Country::all()->pluck('name', 'id');
        $phones = $user->phones->pluck('phone', 'id')->all();
        $phoneStatuses = $user->phones->pluck('phone_status', 'id')->all();
        $emails = $user->emails->pluck('email', 'id')->all();
        $emailStatuses = $user->emails->pluck('email_status', 'id')->all();

        return view('phonebook.mycontact',
            compact('user','userCountry', 'countries', 'phones', 'emails', 'phoneStatuses', 'emailStatuses')
        );
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $user->edit($request->all());

        return redirect()->back()->with('status', 'Contact updated!');
    }
}
