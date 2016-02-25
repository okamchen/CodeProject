<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use CodeProject\Entities\User;
use CodeProject\Entities\Project;

class ProjectMembers extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'project_members';

    protected $fillable = [
    	'project_id',
    	'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

}
