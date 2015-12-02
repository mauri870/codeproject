<?php

namespace Codeproject\Http\Controllers;

use Codeproject\Repositories\ProjectNoteRepository;
use Codeproject\Repositories\ProjectTaskRepository;
use Codeproject\Services\ProjectNoteService;
use Codeproject\Services\ProjectTaskService;
use Illuminate\Http\Request;

use Codeproject\Http\Requests;
use Codeproject\Http\Controllers\Controller;

class ProjectTaskController extends Controller
{

    /**
     * @var ProjectTaskService
     */
    private $service;
    /**
     * @var ProjectTaskRepository
     */
    private $repository;

    public function __construct(ProjectTaskRepository $repository, ProjectTaskService $service)
    {
        $this->service = $service;
        $this->repository = $repository;
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
    public function show($id, $taskId)
    {
        return $this->repository->findWhere(['project_id'=>$id,'id'=>$taskId]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $taskId)
    {
        return $this->service->update($request->all(), $taskId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$taskId)
    {
        return $this->repository->delete($taskId);
    }
}
