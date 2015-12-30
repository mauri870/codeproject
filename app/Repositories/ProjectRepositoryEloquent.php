<?php
/**
 * Created by PhpStorm.
 * User: mauri870
 * Date: 24/11/15
 * Time: 09:44
 */

namespace Codeproject\Repositories;

use Codeproject\Entities\Project;
use Prettus\Repository\Eloquent\BaseRepository;

class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
    public function model()
    {
        return Project::class;
    }


    /**
     * Check if user has a project owner
     *
     * @param $projectId
     * @param $userId
     * @return bool
     */
    public function isOwner($projectId, $userId)
    {
        if(count($this->findWhere(['id'=>$projectId,'owner_id'=>$userId]))){
            return true;
        }

        return false;
    }
    
}