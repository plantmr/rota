<?php

namespace Rota\Http\Controllers;

use Illuminate\Http\Request;
use Rota\Models\Day;

class AddController extends Controller
{
    public function adddays(Day $day)
    {
    	$year = 2025;
		$range = array();
		$start = strtotime(date('Y-m-d H:i:s')); 
		$end = strtotime($year.'-12-31');
		 
		do 
		{
		   $range[] = date('Y-m-d',$start);
		   $start = strtotime("+ 1 day",$start);
		} 
		while ( $start <= $end );

		foreach ($range as $rangeday) 
		{
			$day->create([
    		'date' => $rangeday    		
    		]);
		}
	}
}
