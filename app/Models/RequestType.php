<?php

namespace Rota\Models;

use Illuminate\Database\Eloquent\Model;

class RequestType extends Model
{
    protected $table = "requesttypes";

    protected $fillable = [
    	'id',
    	'type'
    ];

    public function request()
    {
         return $this->hasMany(Request::class);
    }
}
