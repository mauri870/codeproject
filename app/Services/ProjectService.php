<?php
/**
 * Created by PhpStorm.
 * User: mauri870
 * Date: 24/11/15
 * Time: 09:53
 */

namespace Codeproject\Services;

use Codeproject\Repositories\ProjectMembersRepository;
use Codeproject\Repositories\ProjectRepository;
use Codeproject\Validators\ProjectValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Prettus\Validator\Exceptions\ValidatorException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProjectService
{
    /**
     * @var ProjectRepository
     */
    protected $repository;
    /**
     * @var ProjectValidator
     */
    private $validator;
    /**
     * @var ProjectMembersRepository
     */
    private $projectMembersRepository;
    /**
     * @var Filesystem
     */
    private $filesystem;
    /**
     * @var Storage
     */
    private $storage;

    public function __construct(ProjectRepository $repository, ProjectValidator $validator, ProjectMembersRepository $projectMembersRepository, Filesystem $filesystem, Storage $storage)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->projectMembersRepository = $projectMembersRepository;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
    }

    /**
     * Create a new Project
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
     * Update a specific project
     *
     * @param $data
     * @param $id
     * @return mixed
     */
    public function update($data, $id)
    {
        $this->validate($data);

        return $this->repository->update($data, $id);
    }

    /**
     * Destroy a specific project
     *
     * @param $id
     * @return int
     */
    public function destroy($id)
    {
        $this->checkProjectExists($id);
        return $this->repository->delete($id);
    }

    /**
     * Add a new member
     *
     * @param $projectId
     * @param $userId
     * @return mixed
     */
    public function addMember($projectId, $userId)
    {
        $this->checkProjectExists($projectId);
        $member = $this->repository->isMember($projectId,$userId);
        if($member == false){
            return $this->projectMembersRepository->create(['project_id' => $projectId, 'user_id' => $userId]);
        }else{
            return [
                'error' => true,
                'message' => '',
            ];
        }

    }

    /**
     * Remove a member
     *
     * @param $projectId
     * @param $userId
     * @return mixed
     */
    public function removeMember($projectId, $userId)
    {
        $this->checkProjectExists($projectId);
        $memberId = $this->repository->isMember($projectId, $userId);
        if(!$memberId == false){
            return $this->projectMembersRepository->delete($memberId);
        }else{
            return [
                'error' => true,
                'message' => 'Membro inexistente',
            ];
        }

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
     * Check if project exists
     *
     * @param $id
     */
    private function checkProjectExists($id)
    {
        try {

            $this->repository->find($id);

        } catch (\Exception $e) {
            if ($e instanceof ModelNotFoundException || $e instanceof NotFoundHttpException) {
                echo json_encode([
                    'error' => true,
                    'message' => 'Projeto nao encontrado'
                ]);

                exit;
            }
        }
    }

    /**
     * Create a new file
     * @param array $data
     */
    public function createFile(array $data)
    {
        $project = $this->repository->skipPresenter()->find($data['project_id']);
        $projectFile = $project->files()->create($data);

        $this->storage->put($projectFile->id.".".$data['extension'],   $this->filesystem->get($data['file']));

    }
}