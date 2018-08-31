<?php

namespace Rota\Http\Controllers;

use Illuminate\Http\Request;
use Rota\Models\Person;
use Rota\Models\Item;
use Rota\Models\Week;
use Rota\Models\Day;

class ShowController extends Controller
{
    protected $itemarray = [];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($wkno, Request $request, Person $person, Item $item, Week $week, Day $day)
    {
        // Get range of days in week
        $weekrange = $week::where('id', $wkno)->get()->first();

        // Get days in week
        $days = $day::where('date', '>=', $weekrange->start_date)->where('date', '<=', $weekrange->end_date)->get();  
        
        // Get data for each day
        foreach ($days as $day) 
        {
            $itemarray[] = Item::orderBy('roles_id')->where('days_id', $day->id)->get();
        }

        // Get number of weeks in year (possible 53 weeks in leap year)
        $noweeks = $week::where('year', date('Y'))->get();
        
        return view('show')->with([
    		'items' => $itemarray,
    		// 'persons' => $persons,
            'day' =>  $itemarray[0],
            'prev' => $wkno - 1,
            'next' => $wkno +1,
            'noweeks' => $noweeks,
            'weeknumber' => $wkno
    	]);
    }

    public function month($id, Request $request, Person $person, Item $item, Week $week, Day $day)
    {
        dd($id);

    }

    public function submitForm(Request $request, Person $person, Item $item, Week $week, Day $day)
    {
        // Get range of days in week
        $weekrange = $week::where('id', $request->weekno)->get()->first();

        // Get days in week
        $days = $day::where('date', '>=', $weekrange->start_date)->where('date', '<=', $weekrange->end_date)->get();  
        
        // Get data for each day
        foreach ($days as $day) 
        {
            $itemarray[] = Item::orderBy('roles_id')->where('days_id', $day->id)->get();
        }

        // Get number of weeks in year (possible 53 weeks in leap year)
        $noweeks = $week::where('year', date('Y'))->get();
        
        return view('show')->with([
            'items' => $itemarray,
            // 'persons' => $persons,
            'day' =>  $itemarray[0],
            'prev' => $request->weekno - 1,
            'next' => $request->weekno +1,
            'noweeks' => $noweeks,
            'weeknumber' => $request->weekno 
        ]);

    }
}
