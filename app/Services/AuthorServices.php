<?php


namespace App\Services;

use App\Author;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorServices
{
    public function __construct()
    {

    }

    private function validateParams(Request $params)
    {
        return Validator::make($params->data, [
            'name' => 'string',
            'rating' => 'numeric'
        ]);
    }

    public function getAuthors(Request $request)
    {
        $page = $request->page ?: 1;
        $limit = $request->limit ?: 20;
        $query = Author::query();
        if ($request->filled('searchString')) {
            $query->whereRaw('CONCAT(`name`,`rating`) LIKE ?', ['%' . $request->searchString . '%']);
        }
        return $query->orderBy('id', 'DESC')->paginate($limit, ["*"], 'page', $page);
    }

    public function createAuthor(Request $request)
    {

        $validation = $this->validateParams($request);
        if ($validation->fails()) {
            return $validation->errors();
        }
        $author = new News();
        $author->fill($request->data);
        $author->save();
        return $author;
    }

    public function findAuthor($id) {
        return Author::findOrFail($id);
    }

    public function updateAuthor(Request $request, $id) {

        $validation = $this->validateParams($request);
        if ($validation->fails()) {
            return $validation->errors();
        }

        $author = Author::find($id);
        $author->update($request->data);
        $author->save();

        return $author;
    }

    public function deleteAuthor($id) {
        $author = Author::findOrFail($id);
        $author->delete();
        return $author;
    }

    public function suggest(Request $request)
    {
        $query = Author::query();
        if ($request->filled('query'))
        {
            $query->whereRaw('name LIKE ?', ['%'.$request->get('query').'%']);
        }
        return $query->get();
    }
}
