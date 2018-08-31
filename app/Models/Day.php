<?php

namespace Rota\Models;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $table = "days";

    protected $fillable = [
    	'date',
    	'weeks_id'
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
