<?php
/**
 * Created by PhpStorm.
 * User: mauri870
 * Date: 24/11/15
 * Time: 09:53
 */

namespace Codeproject\Services;

use Codeproject\Repositories\ProjectRepository;
use Codeproject\Validators\ProjectValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

    public function __construct(ProjectRepository $repository, ProjectValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
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


}