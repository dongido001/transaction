<?php

namespace App\Helpers;

use HNG\Http;

class Request implements Http\RequestInterface {

    /**
     * @var Http\Request
     */
    protected $client;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $driver = new Http\GuzzleRequest(['base_url' => env('HNG_API_URL')]);

        $this->client = new Http\Request($driver, [
            'base_url'      => env('HNG_API_URL'),
            'client_id'     => env('CLIENT_ID'),
            'client_secret' => env('CLIENT_SECRET'),
            'storage_path'  => env('STORAGE_PATH'),
            'scopes'        => explode(',',env('CLIENT_SCOPES')),
        ]);

    }

    /**
     * Send a GET request to the URL.
     *
     * @param  $url
     * @param  $options
     * @return mixed
     */
    public function get($url, array $options = [])
    {
        return $this->client->get($url, $options);
    }

    /**
     * Send a POST request to the URL.
     *
     * @param  $url
     * @param  $params
     * @param  $options
     * @return mixed
     */
    public function post($url, array $params = [], array $options = [])
    {
        return $this->client->post($url, $params, $options);
    }

    /**
     * Send a DELETE request to the URL.
     *
     * @param  $url
     * @param  $params
     * @param  $options
     * @return mixed
     */
    public function delete($url, array $params = [], array $options = [])
    {
        return $this->client->delete($url, $params, $options);
    }

    /**
     * Send a PUT request to the URL.
     *
     * @param       $url
     * @param array $params
     * @param array $options
     * @return mixed
     */
    public function put($url, array $params = [], array $options = [])
    {
        return $this->client->put($url, $params, $options);
    }
}
