<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Country;
use App\User;
use Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

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
        $contact = $user->contact->toArray();

        return view('phonebook.show', [
            'contact'     => $contact,
            'phones'      => $user->contact->phones,
            'emails'      => $user->contact->emails,
            'userCountry' => $user->contact->country->country_name
        ]);
    }

    public function mycontact()
    {
        $user = Auth::user();
        $contact = $user->contact->toArray();

        return view('phonebook.mycontact', [
            'contact'     => $contact,
            'phones'      => $user->contact->phones,
            'emails'      => $user->contact->emails,
            'userCountry' => $user->contact->country->country_name,
            'countries'   => Country::all()->pluck('country_name', 'id')
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'firstname' =>'required',
            'lastname' =>'required',
            'address' =>'required',
            'zipcode' =>'required',
            'email.*' => 'email'
        ]);

        $user = Auth::user();
        $user->edit($request->all());
        $user->contact->editContact($request->all());

        $user->contact->phones->setPhones($request->input('phone'));


        return redirect()->back()->with('status', 'Contact updated!');
    }
}
