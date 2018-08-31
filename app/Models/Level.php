<?php

namespace Rota\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table = "levels";

    protected $fillable = [
    	'person_id',
    	'level'
    ];

    public function persons()
    {
        return $this->belongsTo(Person::class);
    }
}
