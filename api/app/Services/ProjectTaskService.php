<?php
/**
 * Created by PhpStorm.
 * User: RenatoValer
 * Date: 25/07/2015
 * Time: 10:20
 */

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectTaskRepository;
use CodeProject\Validators\ProjectTaskValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class ProjectTaskService
 * @package CodeProject\Services
 */
class ProjectTaskService  {

    /**
     * @var ProjectTaskRepository
     */
    private $repository;

    /**
     * @var ProjectTaskValidator
     */
    private $validator;

    /**
     * @param ProjectTaskRepository $repository
     * @param ProjectTaskValidator $validator
     */
    public function __construct(ProjectTaskRepository $repository, ProjectTaskValidator $validator)
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
            $msg = "Tarefa criada com sucesso.";
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
            $msg = "Tarefa {$id} atualizada com sucesso.";
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
     * @param $projectId
     * @param $taskId
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function show($projectId, $taskId)
    {
        try {
            return $this->repository->findWhere(['project_id' => $projectId, 'id' => $taskId]);
        } catch(ModelNotFoundException $e) {
            return response()->json([$e->getMessage()], 404);
        } //QueryException tratado em Exceptions/Handler.php
    }

    /**
     * @param $projectId
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function all($projectId)
    {
        try {
            return $this->repository->findWhere(['project_id' => $projectId]);
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
            $msg = "Tarefa {$id} removida com sucesso.";
            Log::info($msg);
            return response()->json([$msg], 200);
        } catch(ModelNotFoundException $e) {
            return response()->json([$e->getMessage()], 404);
        } //QueryException tratado em Exceptions/Handler.php
    }

}