<?php

namespace App\Http\Controllers;

use App\Author;
use App\Http\Resources\AuthorResource;
use App\Services\AuthorServices;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

/**
 * Class AuthorController
 * @mixin Author
 * @package App\Http\Controllers
 */

class AuthorController extends Controller
{
    private $authorService;

    public function __construct()
    {
        $this->authorService = new AuthorServices;
    }

    public function index(Request $request)
    {
        return AuthorResource::collection($this->authorService->getAuthors($request));
    }

    public function create(Request $request)
    {
        return new AuthorResource($this->authorService->createAuthor($request));
    }

    public function show($id)
    {
        return new AuthorResource($this->authorService->findAuthor($id));
    }

    public function update(Request $request, $id)
    {
        return new AuthorResource($this->authorService->updateAuthor($request, $id));
    }

    public function destroy($id)
    {
        return new AuthorResource($this->authorService->deleteAuthor($id));
    }

    public function suggest(Request $request)
    {
        return AuthorResource::collection($this->authorService->suggest($request));
    }
}
