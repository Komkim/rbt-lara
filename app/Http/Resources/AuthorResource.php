<?php

namespace App\Http\Resources;

use App\Author;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    /**
     * Class AuthorResource
     * @mixin Author
     * @package App\Http\Resources
     */
    public function toArray($request)
    {
        return [
            'type' => get_class($this),
            'data' => [
                'id' => $this->id,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'name' => $this->name,
                'rating' => $this->rating
            ]
        ];
    }
}
