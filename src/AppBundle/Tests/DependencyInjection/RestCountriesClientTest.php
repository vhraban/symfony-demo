<?php
namespace AppBundle\Tests\DependencyInjection;

use AppBundle\DependencyInjection\RestCountriesClient;
use GuzzleHttp\Client;
use PHPUnit_Framework_TestCase;
use ReflectionClass;

class RestCountriesClientTest extends PHPUnit_Framework_TestCase
{
    public function testRetrieveCountries()
    {
        $jsonString = '[{"name":"hello","element":"rubbish"},{"name":"world","unneeded":"value"}]';
        $expected = [
            "hello",
            "world"
        ];

        $guzzleClientMock = $this->getMockBuilder(Client::class)
                                ->setMethods(array('get', 'getBody'))
                                ->getMock();

        $guzzleClientMock->expects($this->once())
                            ->method('get')
                            ->will($this->returnSelf());

        $guzzleClientMock->expects($this->any())
                            ->method('getBody')
                            ->will($this->returnValue($jsonString));






        $client = new RestCountriesClient();
        $this->changeProtectedValue($client, "client", $guzzleClientMock);
        $countries = $client->getEuropeanCountries();
        $this->assertEquals($expected, $countries);
    }

    protected function changeProtectedValue($instance, $property, $value)
    {
        $reflection = new ReflectionClass($instance);
        $reflection_property = $reflection->getProperty($property);
        $reflection_property->setAccessible(true);
        $reflection_property->setValue($instance, $value);
    }
}
