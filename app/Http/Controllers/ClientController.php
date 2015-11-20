<?php

namespace Codeproject\Http\Controllers;

use Codeproject\Entities\Client;

use Codeproject\Repositories\ClientRepository;
use Illuminate\Http\Request;

use Codeproject\Http\Requests;
use Codeproject\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function index(ClientRepository $repository){
        return $repository->all();
    }

    public function store(Request $request){
        return Client::create($request->all());
    }

    public function show($id){
        return Client::find($id);
    }

    public function edit($id, Request $request){
        $client = Client::find($id);
	    $client->fill($request->all());
        $client->save();
    }

    public function delete($id){
        Client::find($id)->delete();
    }
}
