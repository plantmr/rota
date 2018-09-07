<?php

use Illuminate\HomeController\Request;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Change password
Route::get('/changepasswordshow','HomeController@showChangePasswordForm')->name('changepasspage');
Route::post('/changepasswordshow','HomeController@showChangePasswordForm')->name('changepasspage');
Route::post('/changepassword','HomeController@changePassword')->name('changepassword');



Route::get('/home', 'HomeController@index')->name('home');

Route::get('/testcal', 'TestCalController@testcal')->name('testcal');

Route::get('/adddays', 'AddController@adddays')->name('adddays');

Route::get('/admin', 'AdminController@index')->name('admin');

Route::get('/admin/week/{date}', 'WeekController@index')->name('week');


// Show routes
Route::get('/show/{wkno}', 'ShowController@index')->name('show');
Route::get('/show/this/week', 'ShowController@thisWeek')->name('thisweek');
Route::get('/myrota/{wkno}', 'ShowController@myRota')->name('myrota');
Route::get('/change/{item}', 'ChangeController@index')->name('change');  
Route::post('/changerequest', 'ChangeController@request')->name('request');
Route::post('/change/request/form', 'ChangeController@requestForm')->name('requestform');
Route::get('/showmonth/{id}', 'ShowController@month')->name('month');
Route::post('/showform', 'ShowController@submitForm')->name('form');
Route::post('/showrotaform', 'ShowController@submitRotaForm')->name('rotaform');
Route::get('/weekadmin', 'AdminController@index')->name('admin');


/* 
 * Seeders
 */
Route::get('/seedrequesttypes', function(\Rota\Models\RequestType $requesttype){

	$types = [
		'swap',
		'swapthis',
		'cancel',
		'time'
	];

	foreach ($types as $type) 
	{
		$requesttype->create([
		'type' => $type    		
		]);
	}
});


Route::get('/seeddays', function(\Rota\Models\Day $day){

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

	foreach ($range as $days) 
	{
		$day->create([
		'date' => $days    		
		]);
	}
});

Route::get('/seedroles', function(\Rota\Models\Role $role){

	$roles = [
		'role 1',
		'role 2',
		'role 3',
		'extra',
		'blank'
	];

	foreach ($roles as $rol) 
	{
		$role->create([
		'role' => $rol    		
		]);
	}
});

Route::get('/seedlevels', function(\Rota\Models\Level $level){

	$levels = [
		'Super Admin',
		'Admin',
		'Staff',
		'Guest'
	];

	foreach ($levels as $lev) 
	{
		$level->create([
		'level' => $lev    		
		]);
	}
});

Route::get('/seedpersons', function(\Rota\Models\Person $person){

	$person_array = [
		'first_name' => 'Sarah', 
		'last_name' => 'Whatsit',
		'user_name' => 'whatit',
		'password' => 'password',
		'levels_id' => 1,
		'active' => 1,
		'first_login' => 1,
		'email' => 'sarah.whatsit@torfx.com',
		'tel_num' => '09876543212',
		'mobile' => '1236547896',
		'address' => 'Address, Somewhere, TR13 0BS',
		'notes' => "ret"		
		];

		$person->create($person_array);

});

Route::get('/seedweeknumbers', function(\Rota\Models\Week $week){

	$start = date("Y-m-d", strtotime('2018/01/01'));

	$x = 1;
	while($x <= 52) 
	{
		if($x == 1)
		{
			$start_date = $start;
		}
		else 
		{
			$start_date = date('Y-m-d', strtotime($start_date . ' +7 day'));
		}

		$stop_date = date('Y-m-d', strtotime($start_date . ' +6 day'));
		$year = explode('-', $start_date);

		$week->create([
		'year' => $year[0], 
		'week_no' => $x,
		'start_date' => $start_date,
		'end_date' => $stop_date,   		
		]);

		$x++;
	}
});

Route::get('/seeditems', function(\Rota\Models\Item $item){

	$x = 1;
	while($x <= 4) 
	{
		$items_array = ['roles_id' => $x, 
		'persons_id' => $x,
		'days_id' => 1,
		'start_time' => '09:00:00', 
		'finish_time' => '17:00:00',
		'notes' => 'abcdef',	
		];

		$item->create($items_array);

		$x++;
	}
});

Route::get('/seeddaysweek', function(\Rota\Models\Week $week, \Rota\Models\Day $day){
	$weeks = $week->get();

	foreach ($weeks as $val) {
		echo $val->start_date;
		$day->where('date', '>=', $val->start_date)->where('date', '<=', $val->end_date)->update(['weeks_id' => $val->id]);
	}	 
});

Route::get('/seedpersonsuserid', function(\Rota\Models\Person $person){
	$persons = $person->get();

	$x = 1;
	foreach ($persons as $val) 
	{
		$val->update(['user_id' => $x]);
		$x++;
	}	 
});

Route::get('/seeduser', 'AdminController@makeUser')->name('makeuser');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'AdminController@index')->name('home');

Route::get('/{a}/{b?}/{c?}/{d?}/{e?}', function($a, $b = null, $c = null, $d = null, $e = null){
	echo $a . " / " . $b . " / " . $c . " / " . $d . " / " . $e;
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
