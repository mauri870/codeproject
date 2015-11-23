<?php
/**
 * Created by PhpStorm.
 * User: mauri870
 * Date: 23/11/15
 * Time: 19:17
 */

namespace Codeproject\Services;


use Codeproject\Repositories\ClientRepository;

class ClientService
{
    protected $repository;

    public function __construct(ClientRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->repository->update($data, $id);
    }
}