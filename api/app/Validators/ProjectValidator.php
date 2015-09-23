<?php
/**
 * Created by PhpStorm.
 * User: RenatoValer
 * Date: 25/07/2015
 * Time: 10:56
 */

namespace CodeProject\Validators;

use Prettus\Validator\LaravelValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class ProjectValidator
 * @package CodeProject\Validators
 */
class ProjectValidator extends LaravelValidator implements ValidatorInterface
{

    /**
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'owner_id' => 'required|numeric',
            'client_id' => 'required|numeric',
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'status' => 'required|numeric',
            'progress' => 'required|numeric',
            'due_date' => 'required|date',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'owner_id' => 'required|numeric',
            'client_id' => 'required|numeric',
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'status' => 'required|numeric',
            'progress' => 'required|numeric',
            'due_date' => 'required|date',
        ],
    ];

}