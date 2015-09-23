<?php
/**
 * Created by PhpStorm.
 * User: RenatoValer
 * Date: 25/07/2015
 * Time: 10:20
 */

namespace CodeProject\Services;

use CodeProject\Services\Contracts\ServiceInterface;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class ProjectService
 * @package CodeProject\Services
 */
class ProjectService implements ServiceInterface {

    /**
     * @var ProjectRepository
     */
    private $repository;

    /**
     * @var ProjectValidator
     */
    private $validator;

    /**
     * @param ProjectRepository $repository
     * @param ProjectValidator $validator
     */
    public function __construct(ProjectRepository $repository, ProjectValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $create = $this->repository->create($data);
            $msg = "Projeto criado com sucesso.";
            Log::info($msg);
            return response()->json([
                "message"=> $msg,
                "data" => $create->toArray()
            ], 200);
        } catch(ValidatorException $e) {
            return response()->json([$e->getMessageBag()], 400);
        } //QueryException tratado em Exceptions/Handler.php
    }

    /**
     * @param array $data
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(array $data, $id)
    {
        try {
            $this->validator->with($data)->setId($id)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $update = $this->repository->update($data, $id);
            $msg = "Projeto {$id} atualizado com sucesso.";
            Log::info($msg);
            return response()->json([
                "message"=> $msg,
                "data" => $update->toArray()
            ], 200);
        } catch(ValidatorException $e) {
            return response()->json([$e->getMessageBag()], 400);
        } catch(ModelNotFoundException $e) {
            return response()->json([$e->getMessage()], 404);
        } //QueryException tratado em Exceptions/Handler.php

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function show($id)
    {
        try {
            return $this->repository->hidden(['owner_id', 'client_id'])->with(['owner', 'client'])->find($id);
        } catch(ModelNotFoundException $e) {
            return response()->json([$e->getMessage()], 404);
        } //QueryException tratado em Exceptions/Handler.php
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $this->repository->delete($id);
            $msg = "Projeto {$id} removido com sucesso.";
            Log::info($msg);
            return response()->json([$msg], 200);
        } catch(ModelNotFoundException $e) {
            return response()->json([$e->getMessage()], 404);
        } //QueryException tratado em Exceptions/Handler.php
    }

}