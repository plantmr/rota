<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Rota\Models\Person;

class PersonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    protected $person;
    protected $faker;

    public function __construct(Person $person, Faker $faker)
	    {
	    	$this->person = $person;
	    	$this->faker = $faker;
	    }

    public function run()
    {
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
    }
}
