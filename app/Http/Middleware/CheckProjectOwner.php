<?php

namespace CodeProject\Http\Middleware;

use Closure;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use CodeProject\Repositories\ProjectRepositoryEloquent;

class CheckProjectOwner
{

    private $repository;

    public function __construct(ProjectRepositoryEloquent $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $userId = Authorizer::getResourceOwnerId();
        $projecId = $request->project;

        if($this->repository->isOwner($projecId, $userId) == false)
        {
            return ['erro' => 'Access forbidden'];
        }

        return $next($request);
    }
}
