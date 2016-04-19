<?php 

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectFileRepository;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectFileValidator;
use Prettus\Validator\Exceptions\ValidatorException;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as Storage;

class ProjectFileService
{
	protected $repository;

	private $filesystem;
	private $storage;
	private $validator;
	private $repositoryProject;

	public function __construct(ProjectFileRepository $repository, ProjectRepository $repositoryProject, Filesystem $filesystem, Storage $storage, ProjectFileValidator $validator)
	{
		$this->repository = $repository;
		$this->filesystem = $filesystem;
		$this->storage = $storage;
		$this->validator = $validator;
		$this->repositoryProject = $repositoryProject;
	}

	public function createFile(array $data)
	{
		try{
			$this->validator->with($data)->passesOrFail();
			$project = $this->repositoryProject->skipPresenter()->find($data['project_id']);
			$this->storage->put($project->name.".".$data['extension'], $this->filesystem->get($data['file']));
			return $project->files()->create($data);

		}catch (ValidatorException $e){
			return [
				'error' => true,
				'message' => $e->getMessageBag()
			];
		}
	}

	public function removeFile($projectId, $fileName)
	{
		$files = $this->repository->findWhere(['project_id' => $projectId]);

		foreach ($files as $file) {
			if($file->name == $fileName){
				$this->repository->find($file->id)->delete();
			}
		}
		// $this->storage->delete($file->name.".".$file->extension);

	}

}