<?php


namespace App\Services;

use App\Author;
use App\News;
use Illuminate\Http\Request;
use Carbon\Carbon;

class NewsService{

    public function __construct()
    {

    }

    private function validateParams(Request $params)
    {
        return Validator::make($params->data, [
            'title' => 'string',
            'description' => 'string',
            'text' => 'string',
            'author_id' => 'required|numeric'
        ]);
    }

    public function filterNews(Request $filters)
    {
        //return News::query();
        $page = $filters->page ?: 1;
        $limit = $filters->limit ?: 10;
        $query = News::query();
        $query->with('author');

        if ($filters->filled('authorId')) {
            $query->where('author_id', $filters->authorId);
        }
        if($filters->filled('dateFrom')) {

            $query->where('created_at', '>=', Carbon::createFromTimestampMs($filters->dateFrom,'Europe/Moscow')->toDateTimeString());
        }
        if($filters->filled('dateTo')) {
            $query->where('created_at', '<=', Carbon::createFromTimestampMs($filters->dateTo,'Europe/Moscow')->toDateTimeString());
        }
        if($filters->filled('searchString')) {
            $query->whereRaw('title LIKE ?', ['%'.$filters->searchString.'%']);
        }
        if($filters->filled('authorName')) {
            $author = Author::query()->whereRaw('name LIKE ?', ['%'.$filters->authorName.'%']);
            $query->whereIn('author_id', $author->get('id'));
        }
        if($filters->filled('offset')) {
            $query->offset($filters->offset);
        }
        return $query->orderBy('id','DESC')->paginate($limit, ["*"],'page',$page);
    }

    public function findNews($id) {
        return News::findOrFail($id);
    }

    public function deleteNews($id) {
        $news = News::findOrFail($id);
        $news->delete();
        return $news;
    }


}
