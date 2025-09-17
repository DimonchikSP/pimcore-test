<?php
/**
 * Copyright © 2025 Dmytro Shytikov shitikovda@gmail.com
 */

declare(strict_types=1);

namespace App\Command\Product;

use App\Model\Product\Import\ImportProcessor;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\ProgressBar;

/**
 * Class CreateProductsFromUrlCommand.
 */
class ImportProductsDataCommand extends Command
{
    /**
     * URL parameter name.
     */
    private const URL_PARAMETER_NAME = 'url';

    public function __construct(
        private readonly ImportProcessor $productImporter
    ) {
        parent::__construct();
    }

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setDescription(
            'Import products from url in JSON format.'
        );
        $this->addOption(
            'url',
            null,
            InputOption::VALUE_REQUIRED,
            'URL to import products must provide JSON format.'
        );
        $this->setName('app:products:import');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $url = $input->getOption(self::URL_PARAMETER_NAME);
        $progressBar = new ProgressBar($output);
        $progressBar->setFormat(
            '%current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%'
        );

        try{
            $output->writeln('Start importing products data...');
            $this->productImporter->collectDataAndProceedProductImport($url, $progressBar);
            $output->writeln('End importing products data...');
        } catch (\Exception $e) {
            $output->writeln("<error>Error: {$e->getMessage()}</error>");

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
