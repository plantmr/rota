<?php

namespace Rota\Http\Controllers;

use Illuminate\Http\Request;
use Rota\Models\Person;
use Rota\Models\Role;
use Rota\Models\Item;
use Rota\Models\Week;
use Rota\Models\RequestType;
use Rota\Models\ChangeRequest;
use Rota\Mail\AdminEmailRequest;
use Rota\Mail\SwapEmailRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Rota\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class ChangeController extends Controller
{
    protected $itemarray = [];
    protected $timeloop = [];
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->middleware('auth');
    }

    public function index(Item $item, Person $person, Role $role)
    {
        // Get role id
        $role_id = $item->roles_id;

        // Get persons with role
        $roledetails = $role::where('id', $item->roles_id)->get()->first();

        // Get persons details
        $persons_details = $person::where('id', $item->persons_id)->get()->first();

        $personsdetail = $person::where('id', Auth::user()->id )->get()->first();

        // Check if user is qualified to swap
       
        if(Auth::user()->id != $item->persons_id)
        {
            $checkid = false;
            if($personsdetail->roles->count())
            {
                foreach($personsdetail->roles as $role)
                {
                    // echo $role->id . ' - ' . $role_id . '<br>';
                    if($role->id == $role_id)
                    {
                        $checkid = true;
                    }
                }                        
            }
            if($checkid === false)
            {
                return view('notqualified');
            }
        }
        

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
            'person' => $persons_details,
            'hours' => $timeloop
    	]);
    }

    public function request(Request $request, Person $person, Role $role, Item $item, Week $week, Day $day)
    {
        // Get item details
        $itemdetails = $item::where('id', $id)->get()->first();

        // Check if person is qualified to swap

        // Get persons available for this item
        
        return view('requestchange')->with([
            'items' => $itemdetails
        ]);
    }

    public function requestForm(Request $request, Item $item, Person $person, User $user, RequestType $requesttype, ChangeRequest $changerequest)
    {    
        // Get item info
        $iteminfo = $item::where('id', $request->itemid)->get()->first();

         // Input to request table
        $inputchange = new ChangeRequest;

        // Check if already in database
        $checkdata = $inputchange::where('item_id', $request->itemid)->where('request_type_id', 1)->where('request_person_id', Auth::user()->id)->where('subject_person_id', $request->persons)->get()->first();
       
        if($checkdata !== null)
        {
             return view('datasent');
        }

        // Check if request already for this item
        $checkrequest = $inputchange::where('item_id', $request->itemid)->get();
        foreach($checkrequest as $check)
        {
            if($check !== null && $check->resolution === null)
            {
                return view('itemalreadyrequested');
            }
        }

        // Request to swap shift with another qualified person
        if($request->requested == 'swap')
        {    
            // Save in database
            $inputchange->request_type_id = 1;
            $inputchange->request_person_id = Auth::user()->id;
            $inputchange->subject_person_id = $request->persons;
            $inputchange->item_id = $request->itemid;
            $inputchange->date_originated = Carbon::now()->toDateString();
            $inputchange->save();

            // Create new auth token for user
            $user = User::where('id', Auth::user()->id)->get()->first();

            $user->activation_token = Hash::make(uniqid());
            // dd($user->activation_token);
            $user->save();

            // Record request in database
            $requestor = $person::where('id', Auth::user()->id)->get()->first();
            $requested = $person::where('id', $request->persons)->get()->first();
            $act_token = Auth::user()->activation_token;
            $type = 1;
            $requests = [$requestor, $requested, $iteminfo, $act_token, $type];

            // Send email to admin
             Mail::to('admin@test.com')->send(new AdminEmailRequest($requests));

            // Send email to person requested to swap
             // Mail::to($requested->email)->send(new SwapEmailRequest($requests));
             Mail::to($requested->email)->send(new SwapEmailRequest($requests));
             
             return view('requestedswap')->with([
            'requests' => $requests
            ]);
        }
        
        // Request to swap another users shift 
        if($request->requested == 'swapthis')
        {
            // Save in database
            $inputchange->request_type_id = 2;
            $inputchange->request_person_id = Auth::user()->id;
            $inputchange->subject_person_id = $request->swapthis;
            $inputchange->item_id = $request->itemid;
            $inputchange->date_originated = Carbon::now()->toDateString();
            $inputchange->save();

            // Create new auth token for user
            $user = User::where('id', Auth::user()->id)->get()->first();

            $user->activation_token = Hash::make(uniqid());
            // dd($user->activation_token);
            $user->save();

            // Record request in database
            $requestor = $person::where('id', Auth::user()->id)->get()->first();
            $requested = $person::where('id', $request->swapthis)->get()->first();
            $act_token = Auth::user()->activation_token;
            $type = 2;
            $requests = [$requestor, $requested, $iteminfo, $act_token, $type];

            // Send email to admin
             Mail::to('admin@test.com')->send(new AdminEmailRequest($requests));

            // Send email to person requested to swap
             // Mail::to($requested->email)->send(new SwapEmailRequest($requests));
             Mail::to($requested->email)->send(new SwapEmailRequest($requests));
             
             return view('requestedswap')->with([
            'requests' => $requests
            ]);
            
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
