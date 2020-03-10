<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthorResource;
use App\Http\Resources\NewsCollection;
use App\Http\Resources\NewsResource;
use App\News;
use App\Services\NewsService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class NewsController extends Controller
{
    private $newsService;

    public function __construct()
    {
        $this->newsService = new NewsService();
    }

    public function index(Request $request)
    {
        return NewsResource::collection($this->newsService->filterNews($request));
    }

    public function create(Request $request)
    {
        return new NewsResource($this->newsService->createNews($request));
    }

    public function show($id)
    {
        return new NewsResource($this->newsService->findNews($id));
    }

    public function update(Request $request, $id)
    {
        return new NewsResource($this->newsService->updateNews($request, $id));
    }

    public function destroy($id)
    {
        return new NewsResource($this->newsService->deleteNews($id));
    }
}
