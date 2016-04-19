<?php

namespace CodeProject\Entities;

use CodeProject\Entities\Project;
use Illuminate\Database\Eloquent\Model;

class ProjectFile extends Model
{

	protected $table = 'project_files';

    protected $fillable = [
    	'name', 
    	'description', 
    	'extension', 
    ];

	public function project()
	{
		return $this->belongsTo(Project::class);
	}
}
