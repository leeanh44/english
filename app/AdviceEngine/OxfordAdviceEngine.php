<?php
namespace App\AdviceEngine;

abstract class OxfordAdviceEngine
{
    const TYPE_SYNONYMS       = 'synonyms';
    const TYPE_PRONUNCIATIONS = 'pronunciation';
    /**
     * Get base uri from ENV
     *
     * @return string
     */
    private function getBaseUri() : string
    {
        return env('OXFORD_BASE_URI');
    }

    /**
     * Get app id from ENV
     *
     * @return string
     */
    private function getAppId() : string
    {
        return env('OXFORD_APP_ID');
    }

    /**
     * Get app key from ENV
     *
     * @return string
     */
    private function getAppKey() : string
    {
        return env('OXFORD_APP_KEY');
    }

    /**
     * Build request
     *
     * @return array
     */
    public function buildRequest(string $method, string $uri)
    {
        $headers = [
            'app_id' => $this->getAppId(),
            'app_key' => $this->getAppKey(),
        ];
        $baseUri = $this->getBaseUri();
        $resource = $this->getResource();
        return app(OxfordAdviceEngineRequest::class)
            ->setHeaders($headers)
            ->setBaseUri($baseUri)
            ->setMethod($method)
            ->setResource($resource);
    }

    /**
     * Send request
     *
     * @return array
     */
    public function sendRequest(string $method, string $uri)
    {
        $request = $this->buildRequest($method, $uri);
        return app(OxfordAdviceEngineClient::class)
            ->setRequest($request)
            ->sendRequest();
    }

    /**
     * Get method
     *
     * @return array
     */
    public function get()
    {
        $resource = $this->getResource();
        $responseData = $this->sendRequest('GET', $this->getBaseUri());
        return $responseData;
    }
}
