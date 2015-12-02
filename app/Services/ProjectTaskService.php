<?php
/**
 * Created by PhpStorm.
 * User: mauri870
 * Date: 24/11/15
 * Time: 09:53
 */

namespace Codeproject\Services;

use Codeproject\Repositories\ProjectTaskRepository;
use Codeproject\Validators\ProjectTaskValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Validator\Exceptions\ValidatorException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProjectTaskService
{

    /**
     * @var ProjectTaskRepository
     */
    private $repository;
    /**
     * @var ProjectTaskValidator
     */
    private $validator;

    public function __construct(ProjectTaskRepository $repository, ProjectTaskValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * Create a Task
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {

        $this->validate($data);
        return $this->repository->create($data);
    }

    /**
     * Update a task
     *
     * @param $data
     * @param $id
     * @return mixed
     */
    public function update($data, $id, $taskId)
    {
        $this->validate($data);
        $this->checkTaskBelongsToProject($id,$taskId);
        return $this->repository->update($data,$taskId);
    }

    /**
     * @param $taskId
     * @return int
     */
    public function destroy($id,$taskId)
    {
        $this->checkTaskBelongsToProject($id,$taskId);
        return $this->repository->delete($taskId);
    }

    /**
     * Call the validator and catch the errors
     *
     * @param $data
     * @return array
     */
    private function validate($data)
    {
        try {
            $this->validator->with($data)->passesOrFail();

        } catch (ValidatorException $e) {

            return [
                'error' => true,
                'message' => $e->getMessageBag(),
            ];

        }
    }


    /**
     * Check if task belongs to a project
     *
     * @param $projectId
     * @param $taskId
     */
    private function checkTaskBelongsToProject($projectId, $taskId)
    {
        $result = $this->repository->findWhere(['project_id' => $projectId,'id' => $taskId]);

        if($result->isEmpty()){
            echo json_encode([
                'error' => true,
                'message' => 'Esta tarefa nao existe neste projeto.',
            ]);
            exit;
        }
    }
}