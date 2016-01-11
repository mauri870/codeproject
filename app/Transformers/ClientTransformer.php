<?php
/**
 * Created by PhpStorm.
 * User: mauri870
 * Date: 03/01/16
 * Time: 13:53
 */

namespace Codeproject\Transformers;

use Codeproject\Entities\Client;
use League\Fractal\TransformerAbstract;

class ClientTransformer extends TransformerAbstract
{
    public function transform(Client $client)
    {
        return [
            'client_id'=>$client->id,
            'name'=>$client->name,
            'responsible'=>$client->responsible,
            'email'=>$client->email,
            'phone'=>$client->phone,
            'address'=>$client->address,
            'obs'=>$client->obs,
        ];
    }
}