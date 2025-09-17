<?php
/**
 * Copyright © 2025 Dmytro Shytikov shitikovda@gmail.com
 */

declare(strict_types=1);

namespace App\Model\Product\Import\DataParser\JsonDataParser;

use JsonException;
use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

/**
 * Class JsonDataParser.
 */
class JsonDataParser implements DataParserInterface
{
    public function __construct(
        private readonly DecoderInterface $decoder,
    ) {}

    /**
     * @param string $data
     * @return array
     * @throws JsonException
     */
    public function parse(string $data): array
    {
        return $this->decoder->decode($data, JsonEncoder::FORMAT);
    }
}
