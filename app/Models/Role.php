<?php

namespace Rota\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "roles";

    protected $fillable = [
    	'role'
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }

   public function persons()
    {
        return $this->belongsToMany(Person::class);
    }
}
