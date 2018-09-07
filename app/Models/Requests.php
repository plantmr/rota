<?php

namespace Rota\Models;

use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    protected $table = "requests";

    protected $fillable = [
    	'id',
    	'requests_type_id',
    	'request_person_id',
    	'subject_person_id',
    	'item_id',
    	'date_originated',
    	'date_resolved',
    	'resolution',
    	'resolved_by_id'
    ];

    public function requesttype()
    {
        return $this->belongsToMany(RequestType::class);
    }
}
