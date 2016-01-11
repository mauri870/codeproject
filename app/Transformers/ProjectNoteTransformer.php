<?php
/**
 * Created by PhpStorm.
 * User: mauri870
 * Date: 03/01/16
 * Time: 13:53
 */

namespace Codeproject\Transformers;

use Codeproject\Entities\ProjectNote;
use League\Fractal\TransformerAbstract;

class ProjectNoteTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['projects'];

    public function transform(ProjectNote $projectNote)
    {
        return [
            'note_id'=>$projectNote->id,
            'title'=>$projectNote->title,
            'note'=>$projectNote->note,
            'project_id'=>$projectNote->project_id,
        ];
    }

    public function includeProjects(ProjectNote $projectNote)
    {
      return $this->item($projectNote->project, new ProjectTransformer());
    }
}