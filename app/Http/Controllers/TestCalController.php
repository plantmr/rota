<?php

namespace Rota\Http\Controllers;

use Illuminate\Http\Request;
use Rota\Models\Person;
use Rota\Models\Item;
use Rota\Models\Week;
use Rota\Models\Day;

class TestCalController extends Controller
{
    public function testcal(Request $request, Person $person, Item $item, Week $week, Day $day)
    {
    	// Get id of week
        $weekdata = $week::where('week_no', 32)->get()->first();

        // dd($weekdata->id);

        // Get days in week
        $days = $day::where('weeks_id', $weekdata->id)->get();
dd($days);     
        // Get data for each day
        foreach ($days as $day) 
        {

            $itemarray[] = Item::orderBy('roles_id')->where('days_id', $day->id)->get();;
        }
    }
}
