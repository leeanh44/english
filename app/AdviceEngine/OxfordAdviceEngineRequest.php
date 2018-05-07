<?php
namespace App\AdviceEngine;

class OxfordAdviceEngineRequest
{
    private $headers;

    private $baseUri;

    private $method;

    private $resource;

    /**
     * Set headers
     *
     * @param array $headers Headers
     *
     * @return $this
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * Set Base URI
     *
     * @param string $baseUri Base URI
     *
     * @return $this
     */
    public function setBaseUri($baseUri)
    {
        $this->baseUri = $baseUri;
        return $this;
    }

    /**
     * Set method
     *
     * @param string $method method
     *
     * @return $this
     */
    public function setMethod($method)
    {
        $this->method = strtoupper($method);
        return $this;
    }

    /**
     * Set resource
     *
     * @param string $resource resource
     *
     * @return $this
     */
    public function setResource($resource)
    {
        $this->resource = $resource;
        return $this;
    }

    /**
     * Get headers
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Get Base URI
     *
     * @return string
     */
    public function getBaseUri()
    {
        return $this->baseUri;
    }

    /**
     * Get method
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Get resource
     *
     * @return array
     */
    public function getResource()
    {
        return $this->resource;
    }
}
