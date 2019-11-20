<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class AuthorService
{
    use ConsumesExternalService;

    /**
     * The base uri to consume the authors service
     * @var string
     */

    public $baseUri;

    /**
     * The secret to consume the authors service
     * @var string
     */

    public function __construct()
    {
        $this->baseUri = config('services.authors.base_uri');
        $this->secret = config('services.authors.secret');
    }

    /**
     * Obtain full list of author from the author service
     * @return string
     */

    public function obtainAuthors()
    {
        return $this->performRequest('GET', '/authors');
    }

    /**
     * Create new author using author service
     * @return string
     */

    public function createAuthor($data)
    {
        return $this->performRequest('POST', '/authors', $data);
    }

    /**
     * Obtain an author from the author service
     * @return string
     */

    public function obtainAuthor($authorId)
    {
        return $this->performRequest('GET', "/authors/{$authorId}");
    }

    /**
     * Obtain an author from the author service
     * @return string
     */

    public function editAuthor($data, $authorId)
    {
        return $this->performRequest('PUT', "/authors/{$authorId}", $data);
    }

    /**
     * Obtain an author from the author service
     * @param integer authorId
     * @return string
     */

    public function deleteAuthor($authorId)
    {
        return $this->performRequest('DELETE', "/authors/{$authorId}");
    }
}
