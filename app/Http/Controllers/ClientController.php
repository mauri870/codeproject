<?php

namespace Codeproject\Http\Controllers;

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

    public function __construct(ClientRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index(){
        return $this->repository->all();
    }

    public function store(Request $request){
        return $this->repository->create($request->all());
    }

    public function show($id){
        return $this->repository->find($id);
    }

    public function edit($id, Request $request){
        $client = $this->repository->find($id);
	    $client->fill($request->all());
        $client->save();
    }

    public function delete($id){
        $this->repository->find($id)->delete();
    }
}
