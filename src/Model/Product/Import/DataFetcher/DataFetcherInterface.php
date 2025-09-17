<?php
/**
 * Copyright © 2025 Dmytro Shytikov shitikovda@gmail.com
 */

declare(strict_types=1);

namespace App\Model\Product\Import\DataFetcher;

/**
 * DataFetcherInterface.
 */
interface DataFetcherInterface
{
    /**
     * @param string $url
     * @return string
     */
    public function fetchData(string $url): string;
}
