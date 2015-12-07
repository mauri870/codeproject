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


    public function isOwner($projectId, $userId)
    {
        if($this->findWhere(['project_id'=>$projectId,'user_id'=>$userId])){
            return true;
        }

        return false;
    }
    
}