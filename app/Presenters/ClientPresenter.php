<?php
/**
 * Created by PhpStorm.
 * User: mauri870
 * Date: 03/01/16
 * Time: 14:05
 */

namespace Codeproject\Presenters;

use Codeproject\Transformers\ClientTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class ClientPresenter extends FractalPresenter
{
    public function getTransformer()
    {
        return new ClientTransformer;
    }
}