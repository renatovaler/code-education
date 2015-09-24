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
     * @param  string  $clientId
     * @return Response
     */
    public function show($clientId)
    {
        return $this->service->show($clientId);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $clientId
     * @return Response
     */
    public function edit($clientId)
    {
        // edit desnecessário, pois o formulário será gerado pelo template em AngularJS
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  string  $clientId
     * @return Response
     */
    public function update(Request $request, $clientId)
    {
        return $this->service->update($request->all(), $clientId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $clientId
     * @return Response
     */
    public function destroy($clientId)
    {
        return $this->service->destroy($clientId);
    }

}
