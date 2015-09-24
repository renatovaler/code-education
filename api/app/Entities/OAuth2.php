<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class OAuth2
 * @package CodeProject\Entities
 */
class OAuth2 extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * @var string
     */
    protected $table = 'oauth_clients';

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'secret',
        'name'
    ];

    /**
     * @var array
     */
    //protected $hidden = ['id'];

}
