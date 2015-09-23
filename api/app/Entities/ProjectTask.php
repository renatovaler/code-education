<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class ProjectTask
 * @package CodeProject\Entities
 */
class ProjectTask extends Model implements Transformable
{
    use TransformableTrait;


    /**
     * @var string
     */
    protected $table = 'project_tasks';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'project_id',
        'status',
        'start_date',
        'due_date'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
