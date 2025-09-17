<?php
/**
 * Copyright © 2025 Dmytro Shytikov shitikovda@gmail.com
 */

declare(strict_types=1);

namespace App\Model\Product\Import;

use App\Model\Product\Import\DataFetcher\DataFetcherInterface;
use App\Model\Product\Import\DataMapper\ProductDataMapper;
use App\Model\Product\Import\DataParser\JsonDataParser\DataParserInterface;
use App\Model\Product\Import\ImportProduct\ImportProductFromDto;
use Exception;
use Symfony\Component\Console\Helper\ProgressBar;

/**
 * Class ProductImporter.
 */
class ImportProcessor
{
    public function __construct(
        private readonly DataFetcherInterface $productDataFetcher,
        private readonly DataParserInterface $productDataParser,
        private readonly ProductDataMapper $productDataMapper,
        private readonly ImportProductFromDto $importProductFromDto,
    ) {}

    /**
     * @param string $url
     * @return void
     * @throws Exception
     */
    public function collectDataAndProceedProductImport(string $url, ProgressBar $progressBar): void
    {
        $dataFromUrl = $this->productDataFetcher->fetchData($url);
        $parsedData = $this->productDataParser->parse($dataFromUrl);
        $productsMappedData = $this->productDataMapper->mapDataToDto($parsedData);

        if (!empty($productsMappedData)) {
            foreach ($progressBar->iterate($productsMappedData) as $productData) {
                try {
                    $this->importProductFromDto->upsert($productData);
                } catch (Exception $exception) {
                    throw new Exception($exception->getMessage());
                }
            }
        }
    }
}
