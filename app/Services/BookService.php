<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class BookService
{
    use ConsumesExternalService;

    /**
     * The base uri to consume the books service
     * @var string
     */

    public $baseUri;

    /**
     * The secret to consume the books service
     * @var string
     */

    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.books.base_uri');
        $this->secret = config('services.books.secret');
    }

    /**
     * Obtain full list of books from the author service
     * @return string
     */

    public function obtainBooks()
    {
        return $this->performRequest('GET', '/books');
    }

    /**
     * Create new book using book service
     * @return string
     */

    public function createBook($data)
    {
        return $this->performRequest('POST', '/books', $data);
    }

    /**
     * Obtain an book from the book service
     * @return string
     */

    public function obtainBook($bookId)
    {
        return $this->performRequest('GET', "/books/{$bookId}");
    }

    /**
     * Obtain an book from the book service
     * @return string
     */

    public function editBook($data, $bookId)
    {
        return $this->performRequest('PUT', "/books/{$bookId}", $data);
    }

    /**
     * Obtain an book from the book service
     * @param integer authorId
     * @return string
     */

    public function deleteBook($bookId)
    {
        return $this->performRequest('DELETE', "/books/{$bookId}");
    }
}
