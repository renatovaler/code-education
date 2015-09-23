<?php

namespace CodeProject\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeProject\Entities\OAuth2;

/**
 * Class OAuth2RepositoryEloquent
 * @package namespace CodeProject\Repositories;
 */
class OAuth2RepositoryEloquent extends BaseRepository implements OAuth2Repository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OAuth2::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria( app(RequestCriteria::class) );
    }
}