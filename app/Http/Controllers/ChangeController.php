<?php

namespace Rota\Http\Controllers;

use Illuminate\Http\Request;
use Rota\Models\Person;
use Rota\Models\Role;
use Rota\Models\Item;
use Rota\Models\Week;
use Rota\Mail\AdminEmailRequest;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Mail;

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

    public function requestForm(Request $request, Item $item, Person $person)
    {    
        // Get item info
        $iteminfo = $item::where('id', $request->itemid)->get()->first();

        // Request to swap shift with another qualified person
        if($request->requested == 'swap')
        {
            // Get names of requestor and requested
            $requestor = $person::where('id', Auth::user()->id)->get()->first();
            $requested = $person::where('id', $request->persons)->get()->first();
            $requests = [$requestor, $requested, $iteminfo];

            // Record request in database
           

            // Send email to admin
             Mail::to('admin@test.com')->send(new AdminEmailRequest($requests));

            // Send email to person requested to swap
             // Mail::to(Auth::user())->send(new AdminEmailRequest($item));
             // 
             return view('requestedswap')->with([
            'requests' => $requests
        ]);
        }
        
        // Request to swap another users shift 
        if($request->requested == 'swapthis')
        {
            // Record request in database
            

            // Send email to admin
            

            // Send email to person requested to swap
            
        }
        
        // Request to cancel a shift
        if($request->requested == 'cancel')
        {
            // Record request in database
            

            // Send email to admin
            
        }

        // Request to change times of a shift
        if($request->requested == 'time')
        {
            // Record request in database
            

            // Send email to admin
            
        }


        
        

    }
}
