<?php

namespace Codeproject\Http\Controllers;

use Codeproject\Repositories\ProjectRepository;
use Codeproject\Services\ProjectService;
use Illuminate\Http\Request;

use Codeproject\Http\Requests;
use Codeproject\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ProjectFileController extends Controller
{
    /**
     * @var ProjectRepository
     */
    private $repository;
    /**
     * @var ProjectService
     */
    private $service;

    public function __construct(ProjectRepository $repository, ProjectService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store($id,Request $request)
    {
        $file = $request->file('file');

        $data = [
            'project_id'=> $request->project_id,
            'file' => $file,
            'extension'=> $file->getClientOriginalExtension(),
            'description'=> $request->description,
            'name'=> $request->name,
        ];

        $this->service->createFile($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$this->checkProjectPermissions($id)){
            return ['error'=>'Acess Forbbiden'];
        }
        return $this->repository->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($this->checkProjectOwner($id) == false){
            return ['error'=>'Acess Forbbiden'];
        }

        return $this->service->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->checkProjectOwner($id) == false){
            return ['error'=>'Acess Forbbiden'];
        }

        $this->service->destroy($id);
    }
}
