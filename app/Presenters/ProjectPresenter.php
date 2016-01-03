<?php
/**
 * Created by PhpStorm.
 * User: mauri870
 * Date: 03/01/16
 * Time: 14:05
 */

namespace Codeproject\Presenters;

use Codeproject\Transformers\ProjectTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class ProjectPresenter extends FractalPresenter
{
    public function getTransformer()
    {
        return new ProjectTransformer();
    }
}