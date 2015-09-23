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
 * Class ClientValidator
 * @package CodeProject\Validators
 */
class ClientValidator extends LaravelValidator implements ValidatorInterface
{

    /**
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required|max:255',
            'responsible' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required|max:255',
            'responsible' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required'
        ],
    ];

}