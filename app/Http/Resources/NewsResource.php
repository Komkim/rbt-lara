<?php

namespace App\Http\Resources;

use App\News;
use Illuminate\Http\Resources\Json\Resource;

class NewsResource extends Resource
{
    /**
     * Class NewsResource
     * @mixin News
     * @package App\Http\Resources
     */
    public function toArray($request)
    {
        return [
            'type' => get_class($this),
            'data' => [
                'id' => $this->id,
                'author_id' => $this->author_id,
                'title' => $this->title,
                'description'=>$this->description,
                'text'=>$this->text
            ]
        ];
    }
}
