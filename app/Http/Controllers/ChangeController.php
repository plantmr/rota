<?php

namespace Rota\Http\Controllers;

use Illuminate\Http\Request;
use Rota\Models\Person;
use Rota\Models\Item;
use Rota\Models\Week;
use Rota\Models\Day;

class ChangeController extends Controller
{
    protected $itemarray = [];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id, Request $request, Person $person, Item $item, Week $week, Day $day)
    {
        dd($id);

        // Get item details
        // $itemdetails = $item::where('id', $id)->get()->first();

        // Get persons available for this item
        
     //    return view('test')->with([
    	// 	'items' => $itemarray,
    	// 	// 'persons' => $persons,
     //        'day' =>  $itemarray[0]
    	// ]);
    }
}
