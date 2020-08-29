<?php
declare(strict_types=1);

namespace Infrastructure\here;

use Exception;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

class HerePort
{
    public const BASE_URL = 'https://wse.ls.hereapi.com/2/';

    private ClientInterface $client;

    private string $apiKey;

    public function __construct()
    {
        $apiKey = 'FAGYuANA28n-y1uzXgMMRtPCuxMrGi9r8TX9fFA_HAk';
        if (!$apiKey) {
            throw new RuntimeException('Missing HERE API Key');
        }
        $this->apiKey = $apiKey;
    }

    public function findSequence(
        string $start,
        array $waypoints,
        string $end
    ): ?array
    {
        $url = self::BASE_URL . 'findsequence.json?start=' . $start;

        foreach ($waypoints as $key => $waypoint) {
            $url .= '&destination' . ($key + 1) . '=' . $waypoint;
        }

        $url .= '&end=' . $end;

        $url .= '&mode=fastest;car&apiKey=' . $this->apiKey;

        try {
            $response = Http::get($url);

            return $this->deserializeResponse($response, true);
        } catch (RequestException $exception) {
            dd($exception);

            return null;
        }
    }

    private function deserializeResponse(Response $response, bool $assoc)
    {
        $data = json_decode($response->body(), $assoc);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Error in decoding Here response');
        }

        return $data;
    }
}
