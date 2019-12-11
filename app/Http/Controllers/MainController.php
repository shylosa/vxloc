<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Throwable;

/**
 * Class MainController
 * @package App\Http\Controllers
 */
class MainController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $user = Auth::user();
        if ($user) {
            //Initialize record in table for new model
            Contact::firstOrCreate(['user_id' => $user->id], ['country_id' => 1]);
        }

        return view('pages.index');
    }
}
