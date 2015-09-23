<?php
/**
 * Created by PhpStorm.
 * User: RenatoValer
 * Date: 25/07/2015
 * Time: 10:20
 */

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectMemberRepository;
use CodeProject\Validators\ProjectMemberValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class ProjectMemberService
 * @package CodeProject\Services
 */
class ProjectMemberService  {

    /**
     * @var ProjectMemberRepository
     */
    private $repository;

    /**
     * @var ProjectMemberValidator
     */
    private $validator;

    /**
     * @param ProjectMemberRepository $repository
     * @param ProjectMemberValidator $validator
     */
    public function __construct(ProjectMemberRepository $repository, ProjectMemberValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * @param $projectId
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function members($projectId)
    {
        try {
            return $this->repository->findWhere(['project_id' => $projectId]);
        } catch(ModelNotFoundException $e) {
            return response()->json([$e->getMessage()], 404);
        } //QueryException tratado em Exceptions/Handler.php
    }

    /**
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $create = $this->repository->create($data);
            $msg = "Membro adicionado com sucesso.";
            Log::info($msg);
            return response()->json([
                "message"=> $msg,
                "data"   => $create->toArray()
            ]);
        } catch(ValidatorException $e) {
            return response()->json([$e->getMessageBag()], 400);
        } //QueryException tratado em Exceptions/Handler.php
    }

    public function remove($projectId, $memberId)
    {
        try {
            $this->repository->findWhere(['project_id' => $projectId, 'user_id' => $memberId])->delete();
            $msg = "Membro removido com sucesso.";
            Log::info($msg);
            return response()->json([$msg], 200);
        } catch(ModelNotFoundException $e) {
            return response()->json([$e->getMessage()], 404);
        } //QueryException tratado em Exceptions/Handler.php
    }

    public function isMember($projectId, $memberId)
    {
        try {
            return $this->repository->findWhere(['project_id' => $projectId, 'user_id' => $memberId])->isEmpty();
        } catch(ModelNotFoundException $e) {
            return false;
        } //QueryException tratado em Exceptions/Handler.php

    }

}