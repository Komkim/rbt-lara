<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class NewsCollection extends ResourceCollection
{
    private $meta;

    public function __construct($resource)
    {
        $this->meta = [
            'total' => $resource->total(),
            'count' => $resource->count(),
            'perPage' => $resource->perPage(),
            'currentPage' => $resource->currentPage(),
            'totalPages' => $resource->lastPage()
        ];
    }

    public function toArray($request)
    {
        return [
            'type' => get_class($this),
            'data' => $this->collection,
            'meta' => $this->meta
        ];
    }
}
