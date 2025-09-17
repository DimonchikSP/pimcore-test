<?php
/**
 * Copyright © 2025 Dmytro Shytikov shitikovda@gmail.com
 */

declare(strict_types=1);

namespace App\Model\Product\Import\ImageProcessor;

use Pimcore\Model\Asset\Image;

/**
 * Class ImageProcessor.
 */
class ImageProcessor
{
    private const DEFAULT_IMAGE_NAME = '/default.jpg';

    /**
     * @param string $path
     * @return Image
     */
    public function getAssetByPath(string $path): Image
    {
        $asset = Image::getByPath($path);
        if (is_null($asset)) {
            $asset = Image::getByPath(self::DEFAULT_IMAGE_NAME);
        }

        return $asset;
    }
}
