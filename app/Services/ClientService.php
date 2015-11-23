<?php
/**
 * Created by PhpStorm.
 * User: mauri870
 * Date: 23/11/15
 * Time: 19:17
 */

namespace Codeproject\Services;


use Codeproject\Repositories\ClientRepository;
use Codeproject\Validators\ClientValidator;
use Illuminate\Contracts\Validation\ValidationException;
use Prettus\Validator\Exceptions\ValidatorException;

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

    public function __construct(ClientRepository $repository, ClientValidator $validator)
    {
        $this->repository = $repository;

        $this->validator = $validator;
    }

    /**
     * @param array $data
     * @return mixed
     */
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

    /**
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id)
    {

        try{
            $this->validator->with($data)->passesOrFail();

            return $this->repository->update($data, $id);

        } catch(ValidatorException $e){

            return [
                'error' => true,
                'message' => $e->getMessageBag(),
            ];

        }
    }
}