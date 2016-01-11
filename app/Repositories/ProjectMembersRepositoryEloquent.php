<?php

namespace Codeproject\Repositories;

use Codeproject\Presenters\ProjectMemberPresenter;
use Codeproject\Repositories\ProjectMembersRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Codeproject\Entities\ProjectMembers;

/**
 * Class ProjectMembersRepositoryEloquent
 * @package namespace Codeproject\Repositories;
 */
class ProjectMembersRepositoryEloquent extends BaseRepository implements ProjectMembersRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjectMembers::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Define the repository presenter
     * @return mixed
     */
    public function presenter()
    {
        return ProjectMemberPresenter::class;
    }
}
