<?php

namespace Codeproject\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProjectMembers extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'project_id',
        'user_id',
    ];

    protected $table = 'project_members';

    public function projects()
    {
        return $this->belongsTo(Project::class,'project_id');
    }

    public function members()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
