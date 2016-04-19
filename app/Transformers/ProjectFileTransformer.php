<?php

namespace CodeProject\Transformers;

use CodeProject\Entities\ProjectFile;
use League\Fractal\TransformerAbstract;

class ProjectFileTransformer extends TransformerAbstract
{

	public function transform(ProjectFile $projectFile)
	{
		return [
			'name' => $projectFile->name, 
			'description' => $projectFile->description, 
			'file' => $projectFile->file,
			'extension' => $projectFile->extension,  	
		];
	}

}