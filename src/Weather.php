<?php

namespace Ella123\Weather;

use Ella123\Weather\Exceptions\HttpException;
use Ella123\Weather\Exceptions\InvalidArgumentException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Weather
{
    protected string $key;

    protected array $guzzleOptions = [];

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    public function getHttpClient(): Client
    {
        return new Client($this->guzzleOptions);
    }

    public function setGuzzleOptions(array $options): void
    {
        $this->guzzleOptions = $options;
    }

    /**
     * @param $city
     * @param string $type
     * @param string $format
     * @return string
     * @throws GuzzleException
     * @throws HttpException
     * @throws InvalidArgumentException
     */
    public function getWeather($city, string $type = 'base', string $format = 'json'): string
    {
        $url = 'https://restapi.amap.com/v3/weather/weatherInfo';

        if (!\in_array(\strtolower($format), ['xml', 'json'])) {
            throw new InvalidArgumentException('Invalid response format: ' . $format);
        }

        if (!\in_array(\strtolower($type), ['base', 'all'])) {
            throw new InvalidArgumentException('Invalid type value(base/all): ' . $type);
        }

        $query = array_filter([
                'key' => $this->key,
                'city' => $city,
                'output' => \strtolower($format),
                'extensions' => \strtolower($type),
        ]);

        try {
            $response = $this->getHttpClient()
                    ->get($url, ['query' => $query,])
                    ->getBody()
                    ->getContents();

            return 'json' === $format ? \json_decode($response, true) : $response;
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }
}