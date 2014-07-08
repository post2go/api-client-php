<?php
namespace ParcelGoClient\Core;

use Guzzle\Common\Exception\GuzzleException;
use Guzzle\Http\Exception\BadResponseException;
use ParcelGoClient\Exception\EmptyApiKey;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class Request
{
    private $apiUrl = 'http://api.parcelgo.ru';
    protected $apiKey = '';
    private $apiVersion = 'v1';
    protected $guzzlePlugins = [];
    private $client;

    /**
     * @param string $apiKey
     * @param array $guzzlePlugins
     * @throws \ParcelGoClient\Exception\EmptyApiKey
     */
    public function __construct($apiKey, $guzzlePlugins = [])
    {
        if (empty($apiKey)) {
            throw new EmptyApiKey();
        }
        $this->apiKey = $apiKey;
        $this->guzzlePlugins = $guzzlePlugins;
        $this->client = new \Guzzle\Http\Client();

        if (count($this->guzzlePlugins) > 0) {
            foreach ($this->guzzlePlugins as $plugin) {
                if ($plugin instanceof EventSubscriberInterface) {
                    $this->client->addSubscriber($plugin);
                }
            }
        }
    }

    /**
     * @param $url
     * @param $requestType
     * @param array $data
     * @return array|bool|float|int|string
     * @throws \Exception
     * @throws \Guzzle\Common\Exception\GuzzleException
     */
    public function send($url, $requestType, $data = array())
    {
        $headers = array(
            'x-authorization-token' => $this->apiKey,
            'content-type' => 'application/json'
        );

        switch (strtoupper($requestType)) {
            case "GET":
                $request = $this->client->get(
                    $this->apiUrl . '/' . $this->apiVersion . '/' . $url,
                    $headers,
                    array('query' => $data)
                );
                break;
            case "POST":
                $request = $this->client->post($this->apiUrl . '/' . $this->apiVersion . '/' . $url, $headers, $data);
                break;
            case "PUT":
                $request = $this->client->put($this->apiUrl . '/' . $this->apiVersion . '/' . $url, $headers, $data);
                break;
            default:
                return false;
        }

        try {
            $response = $request->send()->json();
        } catch (BadResponseException $exception) {
            $response = $exception->getResponse()->json();
        } catch (GuzzleException $exception) {
            throw $exception;
        }

        return $response;
    }
}
