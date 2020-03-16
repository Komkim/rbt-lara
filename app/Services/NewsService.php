<?php


namespace App\Services;

use App\Author;
use App\News;
use Illuminate\Http\Request;
use Carbon\Carbon;

/**
 * Class NewsService
 * @package App\Services
 */
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



    /**
     * @param Request $filters
     * @return LengthAwarePaginator
     */
    public function filterNews(Request $filters)
    {
        //return News::query();
        $page = $filters->page ?: 1;
        $limit = $filters->limit ?: 10;
        $query = News::query();
        $query->with('author');

       // return $query->orderBy('id','DESC')->paginate($limit, ["*"],'page',$page);



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
        //dd($query->orderBy('id','DESC')->paginate($limit, ["*"],'page',$page));
        $result = $query->orderBy('id','DESC')->paginate($limit, ["*"],'page',$page);
        //dd($result->total());
        return $result;
    }

    public function countNews(Request $request )
    {

        return News::where('author_id', '=', $request->authorId)->count();
//        $query = News::query();
//        $query->where('author_id', $request->authorId);
//        return $query->count();
    }

    public function createNews(Request $request)
    {

        $validation = $this->validateParams($request);
        if ($validation->fails()) {
            return $validation->errors();
        }
        $data = $request->data;
        $news = new News();
        $news->fill($data);
        $news->save();

        return $news;
    }

    /**
     * @param $id
     * @return News|News[]|News|Model
     */
    public function findNews($id) {
        return News::findOrFail($id);
    }

    /**
     * @param $id
     * @param array $data
     * @return News|News[]|News|Model|null
     */
    public function updateNews(Request $request, $id) {

        $validation = $this->validateParams($request);
        if ($validation->fails()) {
            return $validation->errors();
        }

        $news = News::find($id);
        $news->update($request->data);
        $news->save();

        return $news;
    }

    /**
     * @param $id
     * @return News|News[]|News|Model
     * @throws Exception
     */
    public function deleteNews($id) {
        $news = News::findOrFail($id);
        $news->delete();
        return $news;
    }


}
