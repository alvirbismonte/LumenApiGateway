<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class UserService
{
    use ConsumesExternalService;

    /**
     * The base uri to consume the users service
     * @var string
     */

    public $baseUri;

    /**
     * The secret to consume the users service
     * @var string
     */

    public $clientId;

    /**
     * The secret to consume the users service
     * @var string
     */

    public $clientSecret;

    /**
     * The secret to consume the users service
     * @var string
     */

    public function __construct()
    {
        $this->baseUri = config('services.users.base_uri');
        $this->clientId = config('services.users.client_id');
        $this->clientSecret = config('services.users.client_secret');
    }

    /**
     * Obtain full list of author from the author service
     * @return string
     */

    public function oauthToken()
    {
        return $this->sendRequest('GET', '/app_dev.php/oauth/v2/token');
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
