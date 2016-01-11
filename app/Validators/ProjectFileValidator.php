<?php
/**
 * Created by PhpStorm.
 * User: mauri870
 * Date: 24/11/15
 * Time: 10:36
 */

namespace Codeproject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator
{
    protected $rules = [
        'name' => 'required',
        'file' => 'required',
        'description' => 'required',
        'project_id' => 'required|integer'
    ];
}