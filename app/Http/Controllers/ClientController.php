<?php

namespace Codeproject\Http\Controllers;

use Codeproject\Client;
use Illuminate\Http\Request;

use Codeproject\Http\Requests;
use Codeproject\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function index(){
        return Client::all();
    }

    public function store(Request $request){
        return Client::create($request->all());
    }

    public function show($id){
        return Client::find($id);
    }

    public function delete($id){
        Client::find($id)->delete();
    }
}
