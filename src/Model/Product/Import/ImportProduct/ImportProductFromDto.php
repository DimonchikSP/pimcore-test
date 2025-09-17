<?php
/**
 * Copyright © 2025 Dmytro Shytikov shitikovda@gmail.com
 */

declare(strict_types=1);

namespace App\Model\Product\Import\ImportProduct;

use App\Model\DataObject\Product;
use App\Model\Product\Import\Dto\ProductDto;
use Exception;

/**
 * Class ImportProductFromDto.
 */
class ImportProductFromDto
{
    /**
     * @param ProductDto $productData
     * @return void
     * @throws Exception
     */
    public function upsert(ProductDto $productData): void
    {
        if (!empty($productData->gtin) && !empty($productData->name)) {
            try {
                $product = Product::getByGtin($productData->gtin, 1);
                if (!$product) {
                    $product = Product::create([
                        'key' => $productData->gtin,
                        'parentId' => 1,
                        'published' => true,
                    ]);
                }

                $product->setName($productData->name);
                $product->setGtin($productData->gtin);
                $product->setDate($productData->date);
                $product->setImage($productData->asset);
                $product->save();
            } catch (Exception $exception) {
                throw new Exception($exception->getMessage());
            }
        }
    }
}
