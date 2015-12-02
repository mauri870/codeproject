<?php
/**
 * Created by PhpStorm.
 * User: mauri870
 * Date: 24/11/15
 * Time: 09:53
 */

namespace Codeproject\Services;

use Codeproject\Repositories\ProjectNoteRepository;
use Codeproject\Validators\ProjectNoteValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectNoteService
{
    /**
     * @var ProjectNoteRepository
     */
    protected $repository;
    /**
     * @var ProjectNoteValidator
     */
    private $validator;

    public function __construct(ProjectNoteRepository $repository, ProjectNoteValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * Create a Note
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
     * Update a note
     *
     * @param $data
     * @param $id
     * @return mixed
     */
    public function update($data, $id, $noteId)
    {
        $this->validate($data);
        $this->checkNoteBelongsToProject($id,$noteId);
        return $this->repository->update($data,$noteId);
    }

    /**
     * @param $noteId
     * @return int
     */
    public function destroy($id,$noteId)
    {
        $this->checkNoteBelongsToProject($id,$noteId);
        return $this->repository->delete($noteId);
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
     * Check if note belongs to a project
     *
     * @param $projectId
     * @param $taskId
     */
    private function checkNoteBelongsToProject($projectId, $noteId)
    {
        $result = $this->repository->findWhere(['project_id' => $projectId,'id' => $noteId]);

        if($result->isEmpty()){
            echo json_encode([
                'error' => true,
                'message' => 'Esta nota nao existe neste projeto.',
            ]);
            exit;
        }
    }


}