<?php

namespace CodeProject\Transformers;

use CodeProject\Entities\ProjectTask;
use League\Fractal\TransformerAbstract;

class ProjectTaskTransformer extends TransformerAbstract
{

	public function transform(ProjectTask $projectTask)
	{
		return [
		    'name' => $projectTask->name, 
	        'start_date' => $projectTask->start_date,
	        'due_date' => $projectTask->due_date,
	        'status' => $projectTask->status,
		];
	}

}
