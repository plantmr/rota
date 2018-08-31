<?php

namespace Rota\Models;

use Illuminate\Database\Eloquent\Model;

class Staffrole extends Model
{
	protected $table = 'staffroles';

    protected $fillable = [
    	'role_id',
    	'person_id'
    ];

    public function persons()
    {
        return $this->BelongsToMany(Person::class);
    }

    public function roles()
    {
        return $this->BelongsToMany(Role::class);
    }
}
