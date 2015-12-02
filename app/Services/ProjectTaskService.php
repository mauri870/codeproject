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
use Prettus\Validator\Exceptions\ValidatorException;

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

    public function create(array $data)
    {
        try{
            $this->validator->with($data)->passesOrFail();

            return $this->repository->create($data);

        } catch(ValidatorException $e){

            return [
                'error' => true,
                'message' => $e->getMessageBag(),
            ];

        }
    }

    public function update($data, $id)
    {
        try{
            $this->validator->with($data)->passesOrFail();

            return $this->repository->update($data,$id);

        } catch(ValidatorException $e){

            return [
                'error' => true,
                'message' => $e->getMessageBag(),
            ];

        }
    }


}