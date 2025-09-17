<?php
/**
 * Copyright © 2025 Dmytro Shytikov shitikovda@gmail.com
 */

declare(strict_types=1);

namespace App\Model\Product\Import\Dto;

use DateTime;
use Pimcore\Model\Asset\Image;

/**
 * Class ProductDto.
 */
class ProductDto
{
    public function __construct(
        public readonly string $name,
        public readonly int $gtin,
        public readonly ?Image $asset = null,
        public readonly ?DateTime $date = null,
    ) {}
}
