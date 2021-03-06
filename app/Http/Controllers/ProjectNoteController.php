<?php

namespace Codeproject\Http\Controllers;

use Codeproject\Repositories\ProjectNoteRepository;
use Codeproject\Services\ProjectNoteService;
use Illuminate\Http\Request;

use Codeproject\Http\Requests;
use Codeproject\Http\Controllers\Controller;

class ProjectNoteController extends Controller
{
    /**
     * @var ProjectNoteRepository
     */
    private $repository;
    /**
     * @var ProjectNoteService
     */
    private $service;

    public function __construct(ProjectNoteRepository $repository, ProjectNoteService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return $this->repository->findWhere(['project_id'=>$id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $noteId)
    {
        return $this->repository->findWhere(['project_id'=>$id,'id'=>$noteId]);
    }


    /**
     * Edit the specified resource.
     *
     * @param Request $request
     * @param $id
     * @param $noteId
     * @return mixed
     */
    public function update(Request $request, $id, $noteId)
    {
        return $this->service->update($request->all(),$id, $noteId);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @param $noteId
     */
    public function destroy($id, $noteId)
    {
        $this->service->destroy($id,$noteId);
    }
}
