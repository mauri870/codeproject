<?php

namespace Codeproject\Entities;

use Illuminate\Database\Eloquent\Model;

class ProjectFile extends Model
{
    protected $fillable = [
        'name',
        'description',
        'extension'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(\Codeproject\Entities\Project::class);
    }
}
