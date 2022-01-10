<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class LoginService
{
    use ConsumesExternalService;

    /**
     * Base URI to connect API JIDO
     * @var string
     */
    public $baseUri;


    /**
     * Token to secret apikey login JIDO
     * @var string
     */
    public $token;

    public function __construct()
    {
        $this->baseUri = config('services.loginjido.base_uri');
        $this->token = config('services.loginjido.secret');
    }

    public function login($data)
    {
        return $this->performRequest('POST', '', $data);
    }

}
