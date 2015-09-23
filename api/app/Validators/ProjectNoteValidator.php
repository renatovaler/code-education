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
 * Class ProjectNoteValidator
 * @package CodeProject\Validators
 */
class ProjectNoteValidator extends LaravelValidator implements ValidatorInterface
{

    /**
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'project_id' => 'required|numeric',
            'title' => 'required|max:255',
            'note' => 'required|max:255'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'project_id' => 'required|numeric',
            'title' => 'required|max:255',
            'note' => 'required|max:255'
        ],
    ];

}