<?php
/**
 * Created by PhpStorm.
 * User: mauri870
 * Date: 23/11/15
 * Time: 19:17
 */

namespace Codeproject\Services;


use Codeproject\Repositories\ClientRepository;
use Codeproject\Repositories\ProjectRepository;
use Codeproject\Validators\ClientValidator;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Validator\Exceptions\ValidatorException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ClientService
{
    /**
     * @var ClientRepository
     */
    protected $repository;
    /**
     * @var ClientValidator
     */
    protected $validator;
    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    public function __construct(ClientRepository $repository, ClientValidator $validator, ProjectRepository $projectRepository)
    {
        $this->repository = $repository;

        $this->validator = $validator;

        $this->projectRepository = $projectRepository;
    }

    /**
     * Create a new client
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    /**
     * Update a specific client
     *
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id)
    {
        return $this->repository->update($data, $id);
    }

    /**
     * Destroy a specific client
     *
     * @param $id
     * @return int
     */
    public function destroy($id)
    {
        $this->checkClientExists($id);
        $this->deleteClientProjects($id);

        return $this->repository->delete($id);
    }

    /**
     * Delete client projects
     *
     * @param $id
     * @return bool
     */
    private function deleteClientProjects($id)
    {
        $projects = $this->repository->find($id)->projects()->get();
        if(count($projects) > 0){
            foreach($projects as $project){
                $this->projectRepository->delete($project->id);
            }
        }
        return true;
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
     * Check if client exists
     *
     * @param $id
     */
    private function checkClientExists($id)
    {
        try {

            $this->repository->find($id);

        } catch (\Exception $e) {
            if ($e instanceof ModelNotFoundException || $e instanceof NotFoundHttpException) {
                echo json_encode([
                    'error' => true,
                    'message' => 'Cliente nao encontrado'
                ]);

                exit;
            }
        }
    }
}