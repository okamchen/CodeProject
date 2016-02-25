<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;
use CodeProject\Entities\Client;
use CodeProject\Entities\User;
use CodeProject\Entities\ProjectNote;
use CodeProject\Entities\ProjectTask;
use CodeProject\Entities\ProjectMembers;


class Project extends Model
{

	protected $table = 'projects';

    protected $fillable = [
    	'owner_id', 
    	'client_id', 
    	'name', 
    	'description', 
    	'progress', 
    	'status', 
    	'due_date'
    ];

    public function client()
	{
		return $this->belongsTo(Client::class);
	}

	public function owner()
	{
		return $this->belongsTo(User::class);
	}

	public function notes()
	{
		return $this->hasMany(ProjectNote::class);
	}

	public function tasks()
	{
		return $this->hasMany(ProjectTask::class);
	}

	public function users()
	{
		return $this->belongsToMany(ProjectMembers::class , 'project_members');
	}
}
