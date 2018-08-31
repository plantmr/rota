<?php

namespace Rota\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'persons';

    protected $fillable = [
    	'last_name',
    	'first_name',
    	'user_name',
    	'password',
    	'active',
    	'first_login',
    	'tel_num',
    	'mobile',
    	'address',
    	'email',
    	'level_id',
    	'notes'
    ];
    
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function staffroles()
    {
        return $this->hasMany(Staffrole::class);
    }

    public function levels()
    {
        return $this->hasOne(Level::class);
    }

}
