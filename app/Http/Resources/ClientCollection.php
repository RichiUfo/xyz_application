<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ClientCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'links' => [
                'path' => $this->path(),
            ],
            'meta' => [
                'currentPage'  => $this->currentPage(),
                'lastPage'  => $this->lastPage(),
                'perPage'  => $this->perPage(),
                'count'  => $this->count(),
            ],
        ];
    }

    public function withResponse($request, $response)
    {
        $jsonResponse = json_decode($response->getContent(), true);
        $jsonResponse['links']['firstPage'] = $jsonResponse['links']['first'];
        $jsonResponse['links']['lastPage'] = $jsonResponse['links']['last'];
        $jsonResponse['links']['nextPageUrl'] = $jsonResponse['links']['prev'];
        $jsonResponse['links']['lastPageUrl'] = $jsonResponse['links']['next'];
        unset($jsonResponse['meta']['links']);
        unset($jsonResponse['meta']['path']);
        unset($jsonResponse['meta']['per_page']);
        unset($jsonResponse['meta']['last_page']);
        unset($jsonResponse['meta']['current_page']);
        unset($jsonResponse['links']['first']);
        unset($jsonResponse['links']['last']);
        unset($jsonResponse['links']['prev']);
        unset($jsonResponse['links']['next']);
        $response->setContent(json_encode($jsonResponse));
    }
}
