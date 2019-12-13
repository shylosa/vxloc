<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Country;
use App\Email;
use App\Phone;
use App\User;
use Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

class PhonebookController extends Controller
{
    /**
     * Display a listing of the phonebook
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $contacts = Contact::whereNotNull('firstname')->whereNotNull('lastname')->get();
        $fields = ['contacts' => $contacts];

        return ($request->ajax()) ?
            view('partials.common-phonebook', $fields) :
            view('phonebook.index', $fields);
    }

    /**
     * Show mycontact form
     *
     * @param Request $request
     * @return Factory|View
     */
    public function mycontact(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            //Initialize record in table for new model
            Phone::firstOrCreate(['contact_id' => $user->contact->id]);
            Email::firstOrCreate(['contact_id' => $user->contact->id]);
        }
        $contact = $user->contact->toArray();

        //@TODO Implement correct preservation of old field values in case of validation errors

        $fields = [
            'contact'     => $contact,
            'phones'      => $user->contact->phones,
            'emails'      => $user->contact->emails,
            'userCountry' => $user->contact->country->country_name,
            'countries'   => Country::all()->pluck('country_name', 'id')
        ];
        return ($request->ajax()) ?
            view('partials.mycontact-form', $fields) :
            view('phonebook.mycontact', $fields);
    }

    /**
     * Save form data in database
     *
     * @param Request $request
     * @return Factory|RedirectResponse|Redirector|View
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname'  => 'required',
            'address'   => 'required',
            'zipcode'   => 'required',
            'phone'     => 'required|array|min:1',
            'phone.*'   => 'required|string|distinct|min:10',
            'phone_status' => 'required|array|min:1',
            'email'        => 'required|array|min:1',
            'email.*'      => 'required|email',
            'email_status' => 'required|array|min:1'
        ]);

        $user = Auth::user();
        $id = $user->contact->id;

        //Validation OK
        if (!$validator->fails()) {

            $user->contact->editContact($request->all());
            $user->contact->setPhones($request->input('phone'), $request->input('phone_status'), $id);
            $user->contact->setEmails($request->input('email'), $request->input('email_status'), $id);

            return redirect(route('mycontact'))->with('status', 'Contact updated!');
        }

        //Validation failed
        return redirect(route('mycontact'))->withErrors($validator);
    }

    //@TODO Make universal method for add phone and add email

    /**
     * Add phone for the user
     *
     */
    public function addPhone()
    {
        $user = Auth::user();
        if (!$user) { return; }
        $contact = $user->contact;
        $contact->addField(Phone::class)->id;

        return redirect(route('mycontact'));
    }

    /**
     * Add phone for the user
     *
     */
    public function addEmail()
    {
        $user = Auth::user();
        if (!$user) { return; }
        $contact = $user->contact;
        $contact->addField(Email::class)->id;

        return redirect(route('mycontact'));
    }
}
