<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        "name",
        "rating"
    ];

    public $timestamps = false;
    protected $table  = 'authors';

    public function news()
    {
        return $this->belongsTo('App\News');
    }
    //
}
