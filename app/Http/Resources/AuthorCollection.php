<?php

namespace App\Http\Resources;

use App\Author;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AuthorCollection extends ResourceCollection
{
    /**
     * @mixin Author
     */
    public function toArray($request)
    {
        return [
            'type' => get_class($this),
            'data' => $this->collection
        ];
    }
}
