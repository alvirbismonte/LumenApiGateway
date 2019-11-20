<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use App\Services\BookService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    use ApiResponser;
    /**
     * The service to consume the books microservice
     * @var BookService
     */
    public $bookService;
    /**
     * The service to consume the authors microservice
     * @var BookService
     */
    public $authorService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BookService $bookService, AuthorService $authorService)
    {
        $this->bookService = $bookService;
        $this->authorService = $authorService;
    }

    /**
     * Return the list of book
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return $this->successResponse($this->bookService->obtainBooks());
    }

    /**
     * Create new book
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorService->obtainAuthor($request->author_id);
        return $this->successResponse($this->bookService->createBook($request->all(), Response::HTTP_CREATED));
    }

    /**
     * Obtain and show book
     * @return Illuminate\Http\Response
     */
    public function show($bookId)
    {
        return $this->successResponse($this->bookService->obtainBook($bookId));
    }

    /**
     * Update book
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $bookId)
    {
        return $this->successResponse($this->bookService->editBook($request->all(), $bookId));
    }

    /**
     * Deletes book
     * @return Illuminate\Http\Response
     */
    public function destroy($bookId)
    {
        return $this->successResponse($this->bookService->deleteBook($bookId));
    }
}
