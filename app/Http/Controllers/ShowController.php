<?php

namespace Rota\Http\Controllers;

use Illuminate\Http\Request;
use Rota\Models\Person;
use Rota\Models\Item;
use Rota\Models\Week;
use Rota\Models\Day;
use Rota\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
// dd($weekrange);
        // Get days in week
        $days = $day::where('date', '>=', $weekrange->start_date)->where('date', '<=', $weekrange->end_date)->get();  
// dd($days);        
        // Get data for each day
        foreach ($days as $day) 
        {
            $itemarray[] = Item::orderBy('roles_id')->where('days_id', $day->id)->get();
        }

        // Get number of weeks in year (possible 53 weeks in leap year)
        $noweeks = $week::where('year', $weekrange->year)->get();
      
        return view('show')->with([
    		'items' => $itemarray,
            'day' =>  $itemarray[0],
            'prev' => $wkno - 1,
            'next' => $wkno +1,
            'noweeks' => $noweeks,
            'weeknumber' => $weekrange->week_no
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
        $noweeks = $week::where('year', $weekrange->year)->get();
        
        return view('show')->with([
            'items' => $itemarray,
            // 'persons' => $persons,
            'day' =>  $itemarray[0],
            'prev' => $request->weekno - 1,
            'next' => $request->weekno +1,
            'noweeks' => $noweeks,
            'weeknumber' => $weekrange->week_no 
        ]);
    }

    public function myRota($id, Request $request, Person $person, Item $item, Week $week, Day $day)
    {
        // Get persons id of user
        $person_id = $person::where('user_id', Auth::user()->id)->get()->first();

        // Get range of days in week
        $weekrange = $week::where('id', $id)->get()->first();
     
        $items = $item::where('persons_id', $person_id->id)->where('weeks_id', $id)->get();

        // Get number of weeks in year (possible 53 weeks in leap year)
        $noweeks = $week::where('year', $weekrange->year)->get();
  
        return view('myrota')->with([
            'items' => $items,
            'prev' => $id - 1,
            'next' => $id +1,
            'noweeks' => $noweeks,
            'weeknumber' => $weekrange->week_no 
        ]);
    }

    public function submitRotaForm(Request $request, Person $person, Item $item, Week $week, Day $day)
    {
        // Get persons id of user
        $person_id = $person::where('user_id', Auth::user()->id)->get()->first();

         // Get range of days in week
        $weekrange = $week::where('id', $request->weekno)->get()->first();
     
        $items = $item::where('persons_id', $person_id->id)->where('weeks_id', $request->weekno)->get();

        // Get number of weeks in year (possible 53 weeks in leap year)
        $noweeks = $week::where('year', $weekrange->year)->get();
       
        return view('myrota')->with([
            'items' => $items,
            'prev' => $request->weekno - 1,
            'next' => $request->weekno +1,
            'noweeks' => $noweeks,
            'weeknumber' => $weekrange->week_no 
        ]);     
    }

    public function thisWeek(Week $week)
    {
        // Get todays date
        $dt = Carbon::now();
        $todaydate = $dt->toDateString();

        // Get week number
        $weekdata = $week::where('start_date', '<=', $todaydate)->where('end_date', '>=', $todaydate)->get()->first(); 
        
        return redirect()->route('show', [$weekdata->week_no]);

    }
}
