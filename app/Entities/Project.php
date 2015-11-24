<?php

namespace Codeproject\Entities;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'owner_id',
        'client_id',
        'name',
        'description',
        'progress',
        'status',
        'due_date',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\Codeproject\Entities\User::class,'owner_id');
    }

    public function client()
    {
        return $this->belongsTo(\Codeproject\Entities\Client::class,'client_id');
    }
}
