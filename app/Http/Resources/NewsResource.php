<?php

namespace App\Http\Resources;

use App\News;
use Illuminate\Http\Resources\Json\Resource;

class NewsResource extends Resource
{
    public function toArray($request)
    {
        return [
            'type' => get_class($this),
            'id' => $this->id,
            'author_id' => $this->author_id,
            'title' => $this->title,
            'description'=>$this->description,
            'text'=>$this->text,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
            'author'=> new AuthorResource($this->author)

        ];
    }
}
