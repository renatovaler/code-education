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
            'name' => 'required|max:255',
            'secret' => 'required|max:40',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'id' => 'required|numeric',
            'name' => 'required|max:255',
            'secret' => 'required|max:40'
        ],
    ];

}