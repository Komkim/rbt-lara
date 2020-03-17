<?php

namespace App\Http\Resources;

use App\Author;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    public function toArray($request)
    {
        return [

            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'name' => $this->name,
            'rating' => $this->rating,
            'posts' => $this->news()->count()

        ];
    }
}
