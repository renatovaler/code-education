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
            'project_id' => 'required|numeric',
            'user_id' => 'required|numeric'
        ]
    ];

}