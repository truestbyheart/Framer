<?php
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;


class HttpModule {
    private $client;
    private $error;
    /**
     * @param $base_uri
     * HttpModule constructor.
     */
    public function __construct($base_uri = null)
    {
        if(is_null($base_uri)){
            $this->client = new Client();
        } else {
            $this->client = new Client([
                'base_uri' => $base_uri
            ]);
        }
    }

    public function Http($type, $url){
        try {
           $response = $this->client->request($type, $url);
           return $response->getBody();
        } catch(ClientException $e){
            $this->error = $e->getMessage();
            return $this->error;
        } catch(ServerException $e){
            $this->error = $e->getMessage();
            return $this->error;
        }
    }
}