# Pimcore Test Project Setup

This repository contains a Pimcore test project running in Docker. Follow the steps below to get started.

## 🚀 Setup Instructions
### 1.Clone the repository

```git clone https://github.com/DimonchikSP/pimcore-test/tree/Pimcore_Testwork pimcore```
```cd pimcore```


### 2.	Start Docker containers

```docker compose up -d```


### 3.Access the PHP container

```docker compose exec php bash```


### 4.Install dependencies

```composer install```


### 5.Run Pimcore installation

```php vendor/bin/pimcore-install```

During this step, enter your Pimcore license key when prompted.

### 6.Import products 
URL should be without brackets.

```php bin/console app:products:import --url=http://test.dev/pim/test.json```


### 7.Short logic description
Al logic placed to ```src/Model```
#### 1.CLI command receive URL as parameter ```\App\Command\Product\ImportProductsDataCommand::execute```
#### 2.ImportProcessor.php collect data and proceed trough child services and pass collected data to ImportProductFromDto.php.
#### 2.2.HttpDataFetcher.php request json by URL
#### 2.3.JsonDataParser.php parse received JSON string from URL
#### 2.3.ProductDataMapper.php create DTO objects ProductDto for each product in parsed data.
#### 2.3.ImageProcessor.php provides asset for ProductDto
#### 3.ImportProductFromDto.php save or update DataObjects in Pimcore.
#### 4.Decorator Product.php apply uppercase in name of DataObjects ```\App\Model\DataObject\Product```


⚡ Notes
As base used repository https://github.com/pimcore/skeleton