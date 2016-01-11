<?php

namespace Codeproject\Entities;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'responsible',
        'email',
        'phone',
        'address',
        'obs',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany(\Codeproject\Entities\Project::class);
    }
}
