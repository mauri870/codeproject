<?php
/**
 * Created by PhpStorm.
 * User: mauri870
 * Date: 03/01/16
 * Time: 13:53
 */

namespace Codeproject\Transformers;

use Codeproject\Entities\ProjectTask;
use League\Fractal\TransformerAbstract;

class ProjectTaskTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['projects'];

    public function transform(ProjectTask $projectTask)
    {
        return [
            'task_id'=>$projectTask->id,
            'name'=>$projectTask->name,
            'project_id'=>$projectTask->project_id,
            'start_date'=>$projectTask->start_date,
            'due_date'=>$projectTask->due_date,
            'status'=>$projectTask->status,
        ];
    }

    public function includeProjects(ProjectTask $projectTask)
    {
        return $this->item($projectTask->project, new ProjectTransformer());
    }
}