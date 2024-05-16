<?php

declare(strict_types=1);

namespace App\Service\External\TheMovieDb;

use App\Models\TrendingPositionPeriod;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use InvalidArgumentException;

final class Api
{
    private const API_ENDPOINT_URI = 'https://api.themoviedb.org/3/';

    private ClientInterface $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => self::API_ENDPOINT_URI,
            'headers' => [
                'Authorization' => sprintf('Bearer %s', Config::get('app.the_movies_api_key')),
            ],
        ]);
    }

    public function getTrending(string $period = TrendingPositionPeriod::DAY, int $page = 1, int $perPage = 20): array
    {
        if (!in_array($period, ['day', 'week'])) {
            throw new InvalidArgumentException(sprintf('Invalid time period specified for %s::%s. Valid periods are "%s"|"%s"', __CLASS__, __METHOD__, TrendingPositionPeriod::DAY, TrendingPositionPeriod::WEEK));
        }

        $period = TrendingPositionPeriod::from($period);

        $cacheKey = sprintf('trendingMovies_%s_%s', date('Ymd'), $period->value);

        return Cache::remember($cacheKey, 600, function () use ($period) {
            $response = $this->query(Request::METHOD_GET, sprintf('trending/movie/%s', $period->value));

            return $response['results'];
        });
    }

    public function getConfiguration(string $key = null): mixed
    {
        return Cache::remember('configuration', 600, function () use ($key) {
            $response = $this->query(Request::METHOD_GET, 'configuration');

            return $key ? Arr::get($response, $key) : $response;
        });
    }

    private function query(string $method, string $uri, array $arguments = []): array
    {
        $requestOptions = match($method) {
            Request::METHOD_GET => ['query' => $arguments],
            Request::METHOD_POST => ['body' => $arguments],
        };

        $response = $this->client->request($method, $uri, $requestOptions);

        return json_decode((string) $response->getBody(), true);
    }
}
