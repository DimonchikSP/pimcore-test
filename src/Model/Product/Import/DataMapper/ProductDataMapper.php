<?php
/**
 * Copyright © 2025 Dmytro Shytikov shitikovda@gmail.com
 */

declare(strict_types=1);

namespace App\Model\Product\Import\DataMapper;

use App\Model\DataObject\Product;
use App\Model\Product\Import\Dto\ProductDto;
use App\Model\Product\Import\ImageProcessor\ImageProcessor;
use Carbon\Carbon;

/**
 * Class ProductDataMapper.
 */
class ProductDataMapper
{
    private const DATA_PRODUCTS_ROOT = 'products';

    public function __construct(
        private readonly ImageProcessor $imageProcessor,
    ) {}

    /**
     * @param array $productsData
     * @return array
     */
    public function mapDataToDto(array $productsData): array
    {
        $preparedProducts = [];

        if (!empty($productsData[self::DATA_PRODUCTS_ROOT])
            && is_iterable($productsData[self::DATA_PRODUCTS_ROOT])
        ) {
            foreach ($productsData[self::DATA_PRODUCTS_ROOT] as $productData) {
                $date = Carbon::parse($productData[Product::FIELD_DATE]);
                $asset = $this->imageProcessor->getAssetByPath($productData[Product::FIELD_IMAGE]);
                $dto = new ProductDto(
                    name: $productData[Product::FIELD_NAME],
                    gtin: (int)$productData[Product::FIELD_GTIN],
                    asset: $asset,
                    date: $date,
                );
                $preparedProducts[] = $dto;
            }
        }

        return $preparedProducts;
    }
}
