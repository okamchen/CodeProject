<?php 

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectService
{
	protected $repository;
	protected $validator;


	public function __construct(ProjectRepository $repository, ProjectValidator $validator)
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
		$project = $this->repository->find($id);
		$project = $project->load('client', 'owner');
		return $project;
 	}

	public function all()
	{
		$projects = $this->repository->all();
		$projects = $projects->load('client', 'owner');
		return $projects;
	}
}