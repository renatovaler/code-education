<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectMemberRepository;
use CodeProject\Services\ProjectMemberService;
use Illuminate\Http\Request;

use CodeProject\Http\Requests;

class ProjectMemberController extends Controller
{
    /**
     * @var ProjectMemberRepository
     */
    private $repository;

    /**
     * @var ProjectMemberService
     */
    private $service;

    /**
     * @param ProjectMemberRepository $repository
     */
    public function __construct(ProjectMemberRepository $repository, ProjectMemberService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  int  $projectId
     * @return Response
     */
    public function members($projectId)
    {
        return $this->service->members($projectId);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function add(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $taskId
     * @return Response
     */
    public function remove($projectId, $memberId)
    {
        return $this->service->remove($projectId, $memberId);
    }

    public function isMember($projectId, $memberId)
    {
        return (bool)$this->service->isMember($projectId, $memberId);
    }
}
