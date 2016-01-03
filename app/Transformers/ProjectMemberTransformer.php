<?php
/**
 * Created by PhpStorm.
 * User: mauri870
 * Date: 03/01/16
 * Time: 13:53
 */

namespace Codeproject\Transformers;

use Codeproject\Entities\User;
use League\Fractal\TransformerAbstract;

class ProjectMemberTransformer extends TransformerAbstract
{
    public function transform(User $member)
    {
        return [
            'member_id'=>$member->id,
            'name'=>$member->name,
        ];
    }
}