<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

	protected $table = 'projects';

    protected $fillable = ['owner_id', 
    	'client_id', 
    	'name', 
    	'description', 
    	'progress', 
    	'status', 
    	'due_date'];

    public function client()
	{
		return $this->belongsTo('CodeProject\Entities\Client');
	}

	public function owner()
	{
		return $this->belongsTo('CodeProject\Entities\User');
	}
}
