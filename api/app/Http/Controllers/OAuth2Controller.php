<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\OAuth2Repository;
use CodeProject\Services\OAuth2Service;
use Illuminate\Http\Request;
use CodeProject\Http\Requests;

/**
 * Class OAuth2Controller
 * @package CodeProject\Http\Controllers
 */
class OAuth2Controller extends Controller
{

    /**
     * @var OAuth2Repository
     */
    private $repository;

    /**
     * @var OAuth2Service
     */
    private $service;

    /**
     * @param OAuth2Repository $repository
     */
    public function __construct(OAuth2Repository $repository, OAuth2Service $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->repository->all();
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
    public function show($id)
    {
        return $this->service->show($id);
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
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }

}
