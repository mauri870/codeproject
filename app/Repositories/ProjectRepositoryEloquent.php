<?php
/**
 * Created by PhpStorm.
 * User: mauri870
 * Date: 24/11/15
 * Time: 09:44
 */

namespace Codeproject\Repositories;

use Codeproject\Entities\Project;
use Codeproject\Presenters\ProjectPresenter;
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

    /**
     * Check if user is a member
     *
     * @param $projectId
     * @param $userId
     * @return mixed
     */
    public function isMember($projectId, $userId)
    {
        $project = $this->find($projectId);

        foreach($project->projectMembers as $member){
            if($member->id == $userId){
                return true;
            }
        }
        return false;
    }

    /**
     * Define the repository presenter
     * @return mixed
     */
    public function presenter()
    {
        return ProjectPresenter::class;
    }
}