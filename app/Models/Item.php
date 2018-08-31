<?php

namespace Rota\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = "items";

    protected $fillable = [
    	'roles_id',
    	'persons_id',
    	'days_id',
        'weeks_id',
		'start_time',
		'finish_time',
		'notes'   
	];

    public function persons()
    {
        return $this->belongsTo(Person::class);
    }

    public function weeks()
    {
        return $this->belongsTo(Week::class);
    }

    public function days()
    {
        return $this->belongsTo(Day::class);
    }

    public function roles()
    {
        return $this->belongsTo(Role::class);
    }
}
