<?php

namespace Rota\Http\Controllers;

use Illuminate\Http\Request;

use Rota\Models\Week;
use Rota\Models\Item;

class WeekController extends Controller
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

    public function index(Week $week, $date, Item $item)
    {
    	$weeks = $week->where('start_date', '<=', $date)->where('end_date', '>=', $date)->first();

    	$items = $item->where('weeks_id', $weeks->id)->orderBy('day_id', 'asc')->get();
    	// dd($items);

	    $first = '2018-06-11';
		$last = '2018-06-17';

	    $dates = array();
	    $current = strtotime($first);
	    $last = strtotime($last);

	    while( $current <= $last ) {

	        $dates[] = date('d/m/Y', $current);
	        $current = strtotime('+1 day', $current);
	    }

        dd(dates);
    }
}
