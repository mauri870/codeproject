<?php
/**
 * Created by PhpStorm.
 * User: mauri870
 * Date: 23/11/15
 * Time: 19:44
 */

namespace Codeproject\Validators;


use Prettus\Validator\LaravelValidator;

class ClientValidator extends LaravelValidator
{
    protected $rules = [
        'name' => 'required|max:255',
        'responsible' => 'required|max:255',
        'email' => 'required|email',
        'phone' => 'required',
        'adress' => 'required'
    ];
}