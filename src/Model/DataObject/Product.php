<?php
/**
 * Copyright © 2025 Dmytro Shytikov shitikovda@gmail.com
 */

declare(strict_types=1);

namespace App\Model\DataObject;

use Pimcore\Model\DataObject\Product as BaseProduct;

class Product extends BaseProduct
{
    /**
     * @param string|null $name
     * @return $this
     */
    public function setName(?string $name): static
    {
        return parent::setName(strtoupper((string)$name));
    }
}
