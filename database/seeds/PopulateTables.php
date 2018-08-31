<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Rota\Models\Day;
use Rota\Models\Week;
use Rota\Models\Item;
use Rota\Models\Person;
use Rota\Models\Role;
use Rota\Models\Level;

class PopulateTables extends Seeder
{
    protected $faker;
    protected $day;
    protected $week;
    protected $item;
    protected $person;
    protected $role;
    protected $level;

    public function __construct(Day $day, Week $week, Item $item, Person $person, Role $role, Level $level, Faker $faker)
    {
    	$this->faker = $faker;
    	$this->day = $day;
    	$this->week = $week;
    	$this->item = $item;
    	$this->person = $person;
    	$this->role = $role;
    	$this->level = $level;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed days
    	$year = 2025;
		$range = array();
		// $start = strtotime(date('Y-m-d H:i:s'));
		$start = strtotime('2018/01/01');  		
		$end = strtotime($year.'-12-31');
		 
		do 
		{
		   $range[] = date('Y-m-d',$start);
		   $start = strtotime("+ 1 day",$start);
		} 
		while ( $start <= $end );

		foreach ($range as $days) 
		{
			$this->day->create([
			'date' => $days    		
			]);
		}

		// Seed roles
		$roles = [
				'role 1',
				'role 2',
				'role 3',
				'extra',
				'standby',
				'blank'
			];

		foreach ($roles as $rol) 
		{
			$this->role->create([
			'role' => $rol    		
			]);
		}

		// Seed levels
		$levels = [
			'Super Admin',
			'Admin',
			'Staff',
			'Guest'
		];

		foreach ($levels as $lev) 
		{
			$this->level->create([
			'level' => $lev    		
			]);
		}

		// Seed persons
		foreach(range(1, 15) as $x)
        {
        	$this->person->create([
			'first_name' => $this->faker->firstName($gender = null), 
			'last_name' => $this->faker->lastName,
			'user_name' => $this->faker->userName,
			'password' => $this->faker->password,
			'levels_id' => rand(1, 4),
			'active' => 1,
			'first_login' => 1,
			'email' => $this->faker->email,
			'tel_num' => $this->faker->phoneNumber,
			'mobile' => $this->faker->phoneNumber,
			'address' => $this->faker->address,
			'notes' => $this->faker->sentence(2)		
			]);
		}

		// Seed week numbers
		$weekseed = [
			'2018/01/01',
			'2018/12/31',
			'2019/12/30',
			'2021/01/04',
			'2022/01/03',
			'2023/01/02',
			'2024/01/01',
			'2024/12/30'
		];

		foreach($weekseed as $wksd)
		{
			$start = date("Y-m-d", strtotime($wksd));
			$wknum = 52;

			if($wksd == '2019/12/30')
			{
				$wknum = 53;
			}

			$x = 1;
			while($x <= $wknum) 
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

				$this->week->create([
				'year' => $year[0], 
				'week_no' => $x,
				'start_date' => $start_date,
				'end_date' => $stop_date,   		
				]);

				$x++;
			}
		}

		// Seed items
		$x = 1;
		while($x <= 4) 
		{
			$items_array = ['roles_id' => $x, 
			'persons_id' => $x,
			'days_id' => 1,
			'weeks_id' => 24,
			'start_time' => '09:00:00', 
			'finish_time' => '17:00:00',
			'notes' => 'abcdef',	
			];

			$this->item->create($items_array);

			$x++;
		}

		// Populate weeks_id in days table
		$weeks = $this->week->get();

		foreach ($weeks as $val) {
			$this->day->where('date', '>=', $val->start_date)->where('date', '<=', $val->end_date)->update(['weeks_id' => $val->id]);
		}
	}
}
