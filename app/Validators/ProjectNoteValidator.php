<?php
/**
 * Created by PhpStorm.
 * User: mauri870
 * Date: 24/11/15
 * Time: 10:36
 */

namespace Codeproject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectNoteValidator extends LaravelValidator
{
    protected $rules = [
        'project_id' => 'required|integer',
        'title' => 'required',
        'note' => 'required',
    ];
}