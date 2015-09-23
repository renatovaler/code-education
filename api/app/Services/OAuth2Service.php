<?php
/**
 * Created by PhpStorm.
 * User: RenatoValer
 * Date: 25/07/2015
 * Time: 10:20
 */

namespace CodeProject\Services;

use CodeProject\Repositories\OAuth2Repository;
use CodeProject\Validators\OAuth2Validator;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class OAuth2Service
 * @package CodeProject\Services
 */
class OAuth2Service {

    /**
     * @var OAuth2Repository
     */
    private $repository;

    /**
     * @var OAuth2Validator
     */
    private $validator;

    /**
     * @param OAuth2Repository $repository
     * @param OAuth2Validator $validator
     */
    public function __construct(OAuth2Repository $repository, OAuth2Validator $validator)
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
            $msg = "Novo Client adicionado com sucesso.";
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
            $msg = "Client {$id} atualizado com sucesso.";
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
            return $this->repository->find($id);
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
            $msg = "Client {$id} removido com sucesso.";
            Log::info($msg);
            return response()->json([$msg], 200);
        } catch(ModelNotFoundException $e) {
            return response()->json([$e->getMessage()], 404);
        } //QueryException tratado em Exceptions/Handler.php
    }

    /**
     * @param $username
     * @param $password
     * @return bool
     */
    public function authenticate($username, $password)
    {
        $credentials = [
            'email'    => $username,
            'password' => $password,
        ];
        if (Auth::once($credentials)) {
            return Auth::user()->id;
        }
        Log::info("Tentativa de login falhou. Usuário: {$username}, Senha: {$password}");
        return false;
    }

}