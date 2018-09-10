<?php

namespace Rota\Http\Controllers\Email;

use Illuminate\Http\Request;
use Rota\Http\Controllers\Controller;

class EmailController extends Controller
{
    public function swapagree(Request $request)
    {
    	dd($request->act_token);
    }

    public function swapdecline(Request $request)
    {
    	dd($request->act_token);
    }
}
