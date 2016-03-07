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
     *
     * @throws UnexpectedValueException if broken JSON received
     */
    public function getEuropeanCountries()
    {
        $response = $this->client->get("rest/v1/region/europe");
        $countries = $response->getBody();
        $decoded = json_decode($countries);

        if(is_null($decoded))
        {
            throw new UnexpectedValueException("Could not decode JSON: " . json_last_error_msg());
        }

        //strip out what we do not need
        $filteredCountries = array_map(function($val){
                                                        return $val->name;
                                                    },
                                        $decoded);

        return $filteredCountries;

    }
}
