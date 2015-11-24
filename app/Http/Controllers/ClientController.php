<?php

namespace Codeproject\Http\Controllers;

use Codeproject\Services\ClientService;
use Illuminate\Http\Request;
use Codeproject\Repositories\ClientRepository;
use Codeproject\Http\Requests;
use Codeproject\Http\Controllers\Controller;

class ClientController extends Controller
{
    /**
     * @var ClientRepository
     */
    private $repository;

    /**
     * @var ClientService
     */
    private $service;

    public function __construct(ClientRepository $repository, ClientService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index(){
        return $this->repository->all();
    }

    public function store(Request $request){
        return $this->service->create($request->all());
    }

    public function show($id){
        return $this->repository->find($id);
    }

    public function update($id, Request $request){
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id){
        return $this->repository->find($id)->delete();
    }
}
