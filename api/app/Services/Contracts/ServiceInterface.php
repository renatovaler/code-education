<?php
/**
 * Created by PhpStorm.
 * User: RenatoValer
 * Date: 26/07/2015
 * Time: 15:48
 */

namespace CodeProject\Services\Contracts;


/**
 * Interface ServiceInterface
 * @package CodeProject\Services\Contracts
 */
interface ServiceInterface {

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id);

    /**
     * @param $id
     * @return mixed
     */
    public function show($id);

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id);


}