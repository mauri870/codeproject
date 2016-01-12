<?php

namespace Codeproject\Http\Controllers;

use Codeproject\Repositories\ProjectRepository;
use Codeproject\Services\ProjectService;
use Codeproject\Validators\ProjectFileValidator;
use Illuminate\Http\Request;

use Codeproject\Http\Requests;
use Codeproject\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Prettus\Validator\Exceptions\ValidatorException;

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
    /**
     * @var ProjectFileValidator
     */
    private $fileValidator;

    public function __construct(ProjectRepository $repository, ProjectService $service, ProjectFileValidator $fileValidator)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->fileValidator = $fileValidator;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->fileValidator->setType('create')->with($request->all())->passesOrFail();

        } catch (ValidatorException $e) {

           return [
                'error' => true,
                'message' => $e->getMessageBag(),
            ];
        }

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
     * @param $id
     * @param Request $request
     * @return array
     */
    public function destroy($id, Request $request)
    {
        try {
            $this->fileValidator->setType('destroy')->with($request->all())->passesOrFail();

        } catch (ValidatorException $e) {

            return [
                'error' => true,
                'message' => $e->getMessageBag(),
            ];
        }

        $data = [
            'project_id'=> $request->project_id,
            'file_id' => $request->file_id,
        ];

        $this->service->deleteFile($data);
    }
}
