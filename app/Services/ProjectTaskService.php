<?php 

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectTaskRepository;
use CodeProject\Validators\ProjectTaskValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectTaskService
{
	protected $repository;
	protected $validator;


	public function __construct(ProjectTaskRepository $repository, ProjectTaskValidator $validator)
	{
		$this->repository = $repository;
		$this->validator = $validator;
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
		$projectTask = $this->repository->find($id);
		$projectTask = $projectTask->load('project');
		return $projectTask;
 	}

	public function all()
	{
		$projectTasks = $this->repository->all();
		$projectTasks = $projectTasks->load('project');
		return $projectTasks;
	}
}