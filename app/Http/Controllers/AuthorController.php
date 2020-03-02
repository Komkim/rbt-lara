<?php

namespace App\Http\Controllers;

use App\Author;
use App\Http\Resources\AuthorResource;
use App\Services\AuthorServices;
use Illuminate\Http\Request;

/**
 * Class AuthorController
 * @mixin Author
 * @package App\Http\Controllers
 */

class AuthorController extends Controller
{
    /**
     * @var $authorService
     */
    private $authorService;

    /**
     * AuthorController constructor.
     */
    public function __construct()
    {
        $this->authorService = new AuthorServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $result = $this->authorService->getAuthors($request);
        return new AuthorCollection(new AuthorResource($result));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return new AuthorResource($this->authorService->createAuthor($request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = $this->authorService->findAuthor($id);
        return new AuthorResource($author);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $result = $this->authorService->updateAuthor($request, $id);
        return new AuthorResource($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return new AuthorResource($this->authorService->deleteAuthor($id));
    }
}
