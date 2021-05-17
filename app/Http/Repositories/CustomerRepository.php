<?php

namespace App\Http\Repositories;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Resources\ClientCollection;

class CustomerRepository implements CustomerRepositoryInterface
{

    /**
     * Collect all Clients with users.
     *
     */
    public function all(Request $request)
    {
        $clients = Client::with('user')->filter($request->all())->sortable()->paginate(10);
        
        $clients->getCollection()->transform(function($client, $key){
            return $client->format();
        });

        return new ClientCollection($clients);
    }

}