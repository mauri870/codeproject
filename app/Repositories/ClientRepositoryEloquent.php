<?php
/**
 * Created by PhpStorm.
 * User: mauri870
 * Date: 18/11/15
 * Time: 20:37
 */

namespace Codeproject\Repositories;


use Codeproject\Entities\Client;
use Codeproject\Presenters\ClientPresenter;
use Prettus\Repository\Eloquent\BaseRepository;

class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{
    public function model()
    {
        return Client::class;
    }

    /**
     * Define the repository presenter
     * @return mixed
     */
    public function presenter()
    {
        return ClientPresenter::class;
    }
}