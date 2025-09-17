<?php
/**
 * Copyright © 2025 Dmytro Shytikov shitikovda@gmail.com
 */

declare(strict_types=1);

namespace App\Model\Product\Import\DataParser\JsonDataParser;

/**
 * DataParserInterface.
 */
interface DataParserInterface
{
    /**
     * @param string $data
     * @return array
     */
    public function parse(string $data): array;
}
