<?php

namespace Rota\Http\Controllers\Email;

use Illuminate\Http\Request;
use Rota\Http\Controllers\Controller;

class EmailController extends Controller
{
    public function swapagree(Request $request)
    {
    	$request->act_token;
    	$request->id;
    }

    public function swapdecline(Request $request)
    {
    	$request->act_token;
    	$request->id;
    }
}
