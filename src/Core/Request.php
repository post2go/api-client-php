<?php
namespace ParcelGoClient\Core;

use Guzzle\Common\Exception\GuzzleException;
use Guzzle\Http\Client;
use Guzzle\Http\Exception\BadResponseException;
use ParcelGoClient\Exception\EmptyApiKey;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class Request
{
    private $apiUrl = 'http://api.parcelgo.ru';
    private $apiEndpoint = '/v2/jsonrpc';
    protected $apiKey = '';
    protected $guzzlePlugins = array();
    private $client;

    /**
     * @param string $apiKey
     * @param string $apiUrl
     * @param array $guzzlePlugins
     * @throws \ParcelGoClient\Exception\EmptyApiKey
     */
    public function __construct($apiKey, $apiUrl = '', $guzzlePlugins = array())
    {
        if (empty($apiKey)) {
            throw new EmptyApiKey();
        }
        $this->apiKey = $apiKey;
        if ($apiUrl) {
            $this->apiUrl = $apiUrl;
        }
        $this->client = new Client();
        $this->guzzlePlugins = $guzzlePlugins;
        if (count($this->guzzlePlugins) > 0) {
            foreach ($this->guzzlePlugins as $plugin) {
                if ($plugin instanceof EventSubscriberInterface) {
                    $this->client->addSubscriber($plugin);
                }
            }
        }
    }

    /**
     * @param $method
     * @param array $params
     * @param int $id
     * @param null $endpoint
     * @throws \Exception
     * @throws \Guzzle\Common\Exception\GuzzleException
     * @internal param array $data
     * @return array|bool|float|int|string
     */
    public function call($method, $params = array(), $id = 1, $endpoint = null)
    {
        $headers = array(
            'x-authorization-token' => $this->apiKey,
            'content-type' => 'application/json'
        );

        $request = array(
            'jsonrpc' => '2.0',
            'method' => $method,
            'params' => $params,
            'id' => $id
        );

        $endpoint = !empty($endpoint) ? $endpoint : $this->apiEndpoint;

        try {
            $request = $this->client->post($this->apiUrl . $endpoint, $headers, json_encode($request));
            $response = $request->send()->json();
        } catch (BadResponseException $exception) {
            $response = $exception->getResponse()->json();
        } catch (GuzzleException $exception) {
            throw $exception;
        }

        return $response;
    }

}
