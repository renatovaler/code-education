<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use CodeProject\Services\ProjectNoteService;
use CodeProject\Repositories\ProjectNoteRepository;

/**
 * Class ProjectNoteController
 * @package CodeProject\Http\Controllers
 */
class ProjectNoteController extends Controller
{

    /**
     * @var ProjectNoteRepository
     */
    private $repository;

    /**
     * @var ProjectNoteService
     */
    private $service;

    /**
     * @param ProjectNoteRepository $repository
     */
    public function __construct(ProjectNoteRepository $repository, ProjectNoteService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($projectId)
    {
        return $this->service->all($projectId);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // create desnecessário, pois o formulário será gerado pelo template em AngularJS
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id, $noteId)
    {
        return $this->service->show($id, $noteId);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        // edit desnecessário, pois o formulário será gerado pelo template em AngularJS
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $noteId
     * @return Response
     */
    public function update(Request $request, $noteId)
    {
        return $this->service->update($request->all(), $noteId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $noteId
     * @return Response
     */
    public function destroy($noteId)
    {
        return $this->service->destroy($noteId);
    }
}
