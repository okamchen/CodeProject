<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use CodeProject\Services\ProjectFileService;
use CodeProject\Repositories\ProjectFileRepository;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

use File;

class ProjectFileController extends Controller
{
    private $service;
    private $repository;

    public function __construct(ProjectFileService $service, ProjectFileRepository $repository)
    {
        $this->service = $service;
        $this->repository = $repository;
    }

    
    public function store($projectId, Request $request)
    {

        $file = $request->file('file');

        $data['name'] = $request->name;
        $data['extension'] = $file->getClientOriginalExtension();
        $data['file'] = $file;
        $data['project_id'] = $projectId;
        $data['description'] = $request->description;

        return $this->service->createFile($data);    
        
    }

    public function destroy($projecId, $fileName)
    { 
        return $this->service->removeFile($projecId, $fileName);
    }

}
