<?php

namespace CodeProject\Entities;

use CodeProject\Entities\Project;
use Illuminate\Database\Eloquent\Model;

class OauthClient extends Model
{

	protected $table = 'oauth_clients';

    protected $fillable = [
    	'id', 
    	'secret', 
    	'name', 
    ];

}