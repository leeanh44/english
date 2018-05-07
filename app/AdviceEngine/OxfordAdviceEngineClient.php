<?php
namespace App\AdviceEngine;

use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response;
use App\AdviceEngine\OxfordAdviceEngineRequest;

class OxfordAdviceEngineClient
{
    /**
     * Set request to Advice Engine
     *
     * @return array|null
     */
    public function setRequest(OxfordAdviceEngineRequest $request)
    {
        $this->request = $request;
        return $this;
    }
    
    /**
     * Send request to Advice Engine
     *
     * @return array|null
     */
    public function sendRequest()
    {
        $client = new Client([
            'headers' => $this->request->getHeaders()
        ]);
        try {
            $response = $client->request(
                $this->request->getMethod(),
                $this->request->getBaseUri().$this->request->getResource()
            );
        } catch (\Exception $e) {
            return false;
        }
        return json_decode($response->getBody()->getContents(), true);
    }
}
