<?php
/**
 * Created by PhpStorm.
 * User: mauri870
 * Date: 03/01/16
 * Time: 13:53
 */

namespace Codeproject\Transformers;

use Codeproject\Entities\Project;
use League\Fractal\TransformerAbstract;

class ProjectTransformer extends TransformerAbstract
{
    public function transform(Project $project)
    {
        return [
            'project_id'=>$project->id,
            'project'=>$project->name,
            'description'=>$project->description,
            'project_progress'=>$project->progress,
            'project_status'=>$project->status,
            'due_date'=>$project->due_date,
        ];
    }
}