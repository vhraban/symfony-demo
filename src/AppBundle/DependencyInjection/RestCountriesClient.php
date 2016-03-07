<?php
namespace AppBundle\DependencyInjection;

use UnexpectedValueException;
use GuzzleHttp\Client;
use stdClass;

class RestCountriesClient
{
    const BASE_URL = "https://restcountries.eu";

    protected $client;

    /**
     * Constructor. Creates an instance of the underlying guzzle client
     */
    public function __construct()
    {
        $this->client = new Client(["base_uri" => static::BASE_URL]);
    }

    /**
     * Get a list of european countries
     *
     * @return string[] A list of european countries
     */
    public function getEuropeanCountries()
    {
        $decoded = $this->get('rest/v1/region/europe');

        //strip out what we do not need
        $filteredCountries = array_map(function($val){
                                                        return $val->name;
                                                    },
                                        $decoded);

        return $filteredCountries;
    }

    /**
     * Send a GET request to a given URI and attempt to JSON decode
     *
     * @param string $uri URI to send request to
     *
     * @return StdClass[] Decoded array of StdClasses
     *
     * @throws UnexpectedValueException if broken JSON received
     */
    protected function get($uri)
    {
        $response = $this->client->get($uri);
        $body = $response->getBody();
        $decoded = json_decode($body);

        if(is_null($decoded))
        {
            throw new UnexpectedValueException("Could not decode JSON: " . json_last_error_msg());
        }

        return $decoded;
    }
}
