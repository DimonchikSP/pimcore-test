<?php
/**
 * Copyright © 2025 Dmytro Shytikov shitikovda@gmail.com
 */

declare(strict_types=1);

namespace App\Model\Product\Import\DataFetcher;

use Psr\Log\LoggerInterface;
use RuntimeException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\Exception\HttpExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Class HandleProductJson.
 */
class HttpDataFetcher implements DataFetcherInterface
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly LoggerInterface $logger,
    ) {}

    /**
     * @param string $url
     * @return string
     */
    public function fetchData(string $url): string
    {
        try {
            $this->logger->info('Fetching data from external service', ['url' => $url]);

            $response = $this->httpClient->request(Request::METHOD_GET, $url, [
                'timeout' => 10,
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);

            return $response->getContent();
        } catch (TransportExceptionInterface|HttpExceptionInterface $e) {
            throw new RuntimeException(
                sprintf(
                    'Failed to fetch data from %s: %s',
                    $url,
                    $e->getMessage()
                ),
                0,
                $e
            );
        }
    }
}
