<?php


namespace App\Services;

use App\News;

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
        return News::query();
        $page = $filters->page ?: 1;
        $limit = $filters->limit ?: 20;
        $query = News::query();
        $query->with('author');

        if ($filters->filled('authorId')) {
            $query->where('author_id', $filters->author);
        }
        if($filters->filled('dateFrom')) {
            $query->where('created_at', '>=', Carbon::createFromTimestampMs($filters->create,'Europe/Moscow')->toDateTimeString());
        }
        if($filters->filled('dateTo')) {
            $query->where('created_at', '<=', Carbon::createFromTimestampMs($filters->create,'Europe/Moscow')->toDateTimeString());
        }
        if($filters->filled('searchString')) {
            $query->whereRaw('CONCAT(`text`,`desctiption`,`title`) LIKE ?', ['%'.$filters->searchString.'%']);
        }
        if($filters->filled('offset')) {
            $query->offset($filters->offset);
        }
        return $query->orderBy('id','DESC')->paginate($limit, ["*"],'page',$page);
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
