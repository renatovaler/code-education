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
 * Class ProjectTaskValidator
 * @package CodeProject\Validators
 */
class ProjectTaskValidator extends LaravelValidator implements ValidatorInterface
{

    /**
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required|max:255',
            'project_id' => 'required|numeric',
            'status' => 'required|numeric',
            'start_date' => 'required|date',
            'due_date' => 'required|date'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required|max:255',
            'project_id' => 'required|numeric',
            'status' => 'required|numeric',
            'due_date' => 'required|date'
        ],
    ];

}