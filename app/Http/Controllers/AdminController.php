<?php

namespace Rota\Http\Controllers;

use Illuminate\Http\Request;
use Rota\Models\User;
use Illuminate\Support\Facades\Auth;
Use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	









        
    }


    public function makeUser(User $user)
    {
        $makeuser = $user::where('id', Auth::user()->id)->get()->first();
        $makeuser->name = 'Kellen Koep';
        $makeuser->password = Hash::make('password');
        $makeuser->email = 'kellen.kope@emai.com';
        $makeuser->save();
    }
}
