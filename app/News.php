<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable =[
        "author_id",
        "title",
        "description",
        "text",
        "created_at"
    ];

    //public $timestamps = false;
    protected $table  = 'news';

    public function author()
    {
        return $this->hasOne('App\Author', 'id', 'author_id');
    }
    //
}
