<?php 

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidator;
use CodeProject\Repositories\ProjectMemberRepository;
use CodeProject\Validators\ProjectMemberValidator;
use Prettus\Validator\Exceptions\ValidatorException;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as Storage;

class ProjectService
{
	protected $repository;
	protected $validator;
	protected $validatorMember;

	private $filesystem;
	private $storage;

	public function __construct(ProjectRepository $repository, ProjectValidator $validator, ProjectMemberValidator $validatorMember, Filesystem $filesystem, Storage $storage)
	{
		$this->repository = $repository;
		$this->validator = $validator;
		$this->validatorMember = $validatorMember;
		$this->filesystem = $filesystem;
		$this->storage = $storage;
	}

	public function create(array $data)
	{

		try{
			$this->validator->with($data)->passesOrFail();
			return $this->repository->create($data);
		}catch (ValidatorException $e){
			return [
				'error' => true,
				'message' => $e->getMessageBag()
			];
		}
		
	}

	public function update(array $data, $id)
	{
		try{
			$this->validator->with($data)->passesOrFail();
			return $this->repository->find($id)->update($data);	
		}catch (ValidatorException $e){
			return [
				'error' => true,
				'message' => $e->getMessageBag()
			];
		}
		
	}

	public function destroy($id)
	{
		return $this->repository->find($id)->delete();
	}

	public function show($id)
	{
		$project = $this->repository->find($id);
		// $project = $project->load('client', 'owner');
		return $project;
 	}

	public function all()
	{
		$projects = $this->repository->all();
		// $projects = $projects->load('client', 'owner');
		return $projects;
	}


	public function addMember(array $membersIds, $projectId)
	{

		try{
			$this->validatorMember->with($membersIds)->passesOrFail();
			$project = $this->repository->find($projectId);
			$project->users()->attach($membersIds);

			return $project;
		}catch (ValidatorException $e){
			return [
				'error' => true,
				'message' => $e->getMessageBag()
			];
		}
		
	}


	public function removeMember($projectId, $memberId)
	{
		$project = $this->repository->find($projectId);
		return $project->users()->detach($memberId);
	}

	public function isMember($projectId, $memberId)
	{

		$project = $this->repository->find($projectId);
		
		if($project != null){
			return ['isMember' => 'true'];
		}
		return ['isMember' => 'false'];
		
	}

	public function createFile(array $data)
	{
		$project = $this->repository->skipPresenter()->find($data['project_id']);
		$projectFile = $project->files()->create($data);

		$this->storage->put($projectFile->name.".".$data['extension'], $this->filesystem->get($data['file']));
	}

}