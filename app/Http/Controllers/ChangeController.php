<?php

namespace Rota\Http\Controllers;

use Illuminate\Http\Request;
use Rota\Models\Person;
use Rota\Models\Role;
use Rota\Models\Item;
use Rota\Models\Week;
use Rota\Models\Day;

class ChangeController extends Controller
{
    protected $itemarray = [];
    protected $timeloop = [];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Item $item, Person $person, Role $role)
    {
        // Get role id
        $role_id = $item->roles_id;

        // Get persons with role
         $roledetails = $role::where('id', $item->roles_id)->get()->first();

        // Values for 24hr dropdowns
        $tStart = strtotime("06:00");
        $tEnd = strtotime("23:30");
        $tNow = $tStart;

        while($tNow <= $tEnd)
        {
          $timeloop[] = date("H:i",$tNow);
          $tNow = strtotime('+15 minutes',$tNow);
        }
        
        return view('requestchange')->with([
    		'items' => $item,
            'role' => $roledetails,
            'hours' => $timeloop
    	]);
    }

    public function request(Request $request, Person $person, Role $role, Item $item, Week $week, Day $day)
    {
        

        // Get item details
        $itemdetails = $item::where('id', $id)->get()->first();

        // dd($itemdetails->persons->id);

        // Get persons available for this item
        
        return view('requestchange')->with([
            'items' => $itemdetails
        ]);
    }

    public function requestForm(Request $request, Item $item)
    {
        dd($request->persons);
    }
}
