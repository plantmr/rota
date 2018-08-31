<?php

namespace Rota\Models;

use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
     protected $table = "weeks";

    protected $fillable = [
    	'year',
    	'week_no',
    	'start_date',
    	'end_date'
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
