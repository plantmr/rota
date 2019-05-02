<?php

namespace Rota\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Rota\Models\Day;
use Rota\Models\Item;
use Rota\Models\Person;
use Rota\Models\User;
use Rota\Models\Week;

class ShowController extends Controller {
	protected $itemarray = [];
	protected $day;
	protected $person;
	protected $item;
	protected $week;
	protected $request;

	public function __construct(Day $day, Person $person, Item $item, Week $week, Request $request) {
		$this->middleware('auth');
		$this->day = $day;
		$this->person = $person;
		$this->item = $item;
		$this->week = $week;
		$this->request = $request;
	}

	public function index($wkno) {
		// Get range of days in week
		$weekrange = $this->week::where('id', $wkno)->get()->first();

		// Get days in week
		$days = $this->day::where('date', '>=', $weekrange->start_date)->where('date', '<=', $weekrange->end_date)->get();

		// Get data for each day
		foreach ($days as $day) {
			$itemarray[] = Item::orderBy('roles_id')->where('days_id', $day->id)->get();
		}

		// Get number of weeks in year (possible 53 weeks in leap year)
		$noweeks = $this->week::where('year', $weekrange->year)->get();

		return view('show')->with([
			'items' => $itemarray,
			'day' => $itemarray[0],
			'prev' => $wkno - 1,
			'next' => $wkno + 1,
			'noweeks' => $noweeks,
			'weeknumber' => $weekrange->week_no,
			'weekid' => $wkno,
		]);
	}

	public function month($id) {
		dd($id);

	}

	public function submitForm(Person $person, Item $item, Week $week, Day $day) {
		// Get range of days in week
		$weekrange = $week::where('id', $this->request->weekno)->get()->first();

		// Get days in week
		$days = $day::where('date', '>=', $weekrange->start_date)->where('date', '<=', $weekrange->end_date)->get();

		// Get data for each day
		foreach ($days as $da) {
			$itemarray[] = Item::orderBy('roles_id')->where('days_id', $da->id)->get();
		}

		// Get number of weeks in year (possible 53 weeks in leap year)
		$noweeks = $week::where('year', $weekrange->year)->get();

		return view('show')->with([
			'items' => $itemarray,
			// 'persons' => $persons,
			'day' => $itemarray[0],
			'prev' => $this->request->weekno - 1,
			'next' => $this->request->weekno + 1,
			'noweeks' => $noweeks,
			'weeknumber' => $weekrange->week_no,
			'weekid' => $this->request->weekno,
		]);
	}

	public function myRota($dayno) {
		// Get persons id of user
		$person_id = $this->person::where('user_id', Auth::user()->id)->get()->first();

		// Get range of days in week
		$weekrange = $this->week::where('id', $dayno)->get()->first();

		// Get items
		$items = $this->item::where('persons_id', $person_id->id)->where('weeks_id', $dayno)->get();

		// Get number of weeks in year (possible 53 weeks in leap year)
		$noweeks = $this->week::where('year', $weekrange->year)->get();

		return view('myrota')->with([
			'items' => $items,
			'prev' => $dayno - 1,
			'next' => $dayno + 1,
			'noweeks' => $noweeks,
			'weeknumber' => $weekrange->week_no,
			'weekid' => $dayno,
		]);
	}

	public function submitRotaForm(Request $request, Person $person, Item $item, Week $week, Day $day) {
		// Get persons id of user
		$person_id = $person::where('user_id', Auth::user()->id)->get()->first();

		// Get range of days in week
		$weekrange = $week::where('id', $request->weekno)->get()->first();

		// Get items
		$items = $item::where('persons_id', $person_id->id)->where('weeks_id', $request->weekno)->get();

		// Get number of weeks in year (possible 53 weeks in leap year)
		$noweeks = $week::where('year', $weekrange->year)->get();

		return view('myrota')->with([
			'items' => $items,
			'prev' => $request->weekno - 1,
			'next' => $request->weekno + 1,
			'noweeks' => $noweeks,
			'weeknumber' => $weekrange->week_no,
			'weekid' => $request->weekno,
		]);
	}

	public function thisWeek(Week $week) {
		// Get todays date
		$dt = Carbon::now();
		$todaydate = $dt->toDateString();

		// Get week number
		$weekdata = $week::where('start_date', '<=', $todaydate)->where('end_date', '>=', $todaydate)->get()->first();

		return redirect()->route('show', [$weekdata->week_no]);

	}
}
