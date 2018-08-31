<?php

namespace Rota\Models;

use Illuminate\Database\Eloquent\Model;

class PersonsDate extends Model
{
   protected $table = "personsdate";

    protected $fillable = [
    	'id'
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function weeks()
    {
        return $this->hasMany(Week::class);
    }

    public function days()
    {
        return $this->hasMany(Day::class);
    }
}
