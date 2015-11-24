<?php
/**
 * Created by PhpStorm.
 * User: mauri870
 * Date: 24/11/15
 * Time: 10:36
 */

namespace Codeproject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator
{
    protected $rules = [
        'owner_id' => 'required|integer',
        'client_id' => 'required|integer',
        'name' => 'required|max:255',
        'description' => 'required',
        'progress' => 'required',
        'status' => 'required',
        'due_date' => 'required|date_format:d/m/Y'
    ];
}