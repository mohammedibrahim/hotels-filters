# Hotel Filters

Web service to filter a list of hotels.

<p>
<a href="https://travis-ci.org/mohammedibrahim/hotels-filters/"><img src="https://travis-ci.org/mohammedibrahim/hotels-filters.svg?branch=master" /></a>
<a href="https://codeclimate.com/github/mohammedibrahim/hotels-filters/maintainability"><img src="https://api.codeclimate.com/v1/badges/43cd3f6c1d478430c9b4/maintainability" /></a>
<a href="https://codeclimate.com/github/mohammedibrahim/hotels-filters/test_coverage"><img src="https://api.codeclimate.com/v1/badges/43cd3f6c1d478430c9b4/test_coverage" /></a>
</p>

<!-- TOC depthFrom:1 depthTo:6 withLinks:1 updateOnSave:1 orderedList:0 -->
- [Description](#description)
- [Installation](#installation)
- [How To use](#how-to-use)
    - [RestFul APIs](#restful-apis)
        - [List All Hotels](#list-all-hotels)
        - [Available Filters](#available-filters)
        - [Available Orders](#available-orders)
        - [Available Output format](#available-output-format)
    - [Console](#console)
- [New Filter](#new-filter)
- [New Order](#new-order)
- [New Output Format](#new-output-format)
- [PHP Docs](#php-docs)
- [Test Cases](#test-cases)
<!-- /TOC -->

## Description

An application (console or RESTful API) that allow search in the given inventory by any of the following:
- Hotel Name
- Destination [City]
- Price range [ex: $100:$200]
- Date range [ex: 10-10-2020:15-10-2020]
And allow sorting by:
- Hotel Name
- Price

![](https://raw.githubusercontent.com/mohammedibrahim/hotels-filters/master/assets/classes.png)

## Installation

Using composer :

```bash
git clone http://github.com/mohammedibrahim/hotels-filters.git
cd hotels-filters
composer install
php index.php
```

## How To use

#### RestFul APIs:

Lets assume that your installation has http://localhost/hotels-filters as url and it points to the root of our application.

#### List All Hotels
``
GET http://localhost/hotels-filters
``
##### Response
```json
{
    "data": [
        {
            "name": "Concorde Hotel",
            "price": 79.4,
            "city": "Manila",
            "availability": [
                {
                    "from": "10-10-2020",
                    "to": "19-10-2020"
                },
                {
                    "from": "22-10-2020",
                    "to": "22-11-2020"
                },
                {
                    "from": "03-12-2020",
                    "to": "20-12-2020"
                }
            ]
        },
        {
            "name": "Golden Tulip",
            "price": 109.6,
            "city": "paris",
            "availability": [
                {
                    "from": "04-10-2020",
                    "to": "17-10-2020"
                },
                {
                    "from": "16-10-2020",
                    "to": "11-11-2020"
                },
                {
                    "from": "01-12-2020",
                    "to": "09-12-2020"
                }
            ]
        },
        {
            "name": "Le Meridien",
            "price": 89.6,
            "city": "london",
            "availability": [
                {
                    "from": "01-10-2020",
                    "to": "12-10-2020"
                },
                {
                    "from": "05-10-2020",
                    "to": "10-11-2020"
                },
                {
                    "from": "05-12-2020",
                    "to": "28-12-2020"
                }
            ]
        },
        {
            "name": "Media One Hotel",
            "price": 102.2,
            "city": "dubai",
            "availability": [
                {
                    "from": "10-10-2020",
                    "to": "15-10-2020"
                },
                {
                    "from": "25-10-2020",
                    "to": "15-11-2020"
                },
                {
                    "from": "10-12-2020",
                    "to": "15-12-2020"
                }
            ]
        },
        {
            "name": "Novotel Hotel",
            "price": 111,
            "city": "Vienna",
            "availability": [
                {
                    "from": "20-10-2020",
                    "to": "28-10-2020"
                },
                {
                    "from": "04-11-2020",
                    "to": "20-11-2020"
                },
                {
                    "from": "08-12-2020",
                    "to": "24-12-2020"
                }
            ]
        },
        {
            "name": "Rotana Hotel",
            "price": 80.6,
            "city": "cairo",
            "availability": [
                {
                    "from": "10-10-2020",
                    "to": "12-10-2020"
                },
                {
                    "from": "25-10-2020",
                    "to": "10-11-2020"
                },
                {
                    "from": "05-12-2020",
                    "to": "18-12-2020"
                }
            ]
        }
    ]
}
```

#### Available Filters

Data can be filtered by one or more filters as follow 

| Filter Name  | Type | Description | Default | Example |
| :---         | :---: | :---- | --- | :---- |
| hotel_name  | String  | Filter hotels according to it's name. | Null | filters[hotel_name]=Concorde |
| destination  | String  | Filter hotels with its destination city. | Null | filters[destination]=Cairo |
| price_range  | String  | Filter hotels which has a price between the specified value. | Null | filters[price_range]=100:200 |
| date_range  | String  | Filter hotels which has a availablitiy in the specified date range. | Null | filters[date_range]=10-10-2020:15-10-2020 |

``
GET http://localhost/hotels-filters?filters[hotel_name]=Concorde
``

##### Response
```json
{
    "data": [
        {
            "name": "Concorde Hotel",
            "price": 79.4,
            "city": "Manila",
            "availability": [
                {
                    "from": "10-10-2020",
                    "to": "19-10-2020"
                },
                {
                    "from": "22-10-2020",
                    "to": "22-11-2020"
                },
                {
                    "from": "03-12-2020",
                    "to": "20-12-2020"
                }
            ]
        }
    ]
}
```

#### Available Orders

Data can be ordered by name or value as follow

| Order Name  | Type | Description | Default | Example |
| :---        | :---: | :-------- | --- | :---- |
| name  | String  | Order hotels by name. | asc | order_by=name&order_type=asc |
| price  | String  | Order hotels by price. | asc | order_by=price&order_type=desc |

``
GET http://localhost/hotels-filters?order_by=name&order_type=desc
``

##### Response
```json
{
    "data": [
        {
            "name": "Concorde Hotel",
            "price": 79.4,
            "city": "Manila",
            "availability": [
                {
                    "from": "10-10-2020",
                    "to": "19-10-2020"
                },
                {
                    "from": "22-10-2020",
                    "to": "22-11-2020"
                },
                {
                    "from": "03-12-2020",
                    "to": "20-12-2020"
                }
            ]
        },
        {
            "name": "Golden Tulip",
            "price": 109.6,
            "city": "paris",
            "availability": [
                {
                    "from": "04-10-2020",
                    "to": "17-10-2020"
                },
                {
                    "from": "16-10-2020",
                    "to": "11-11-2020"
                },
                {
                    "from": "01-12-2020",
                    "to": "09-12-2020"
                }
            ]
        },
        {
            "name": "Le Meridien",
            "price": 89.6,
            "city": "london",
            "availability": [
                {
                    "from": "01-10-2020",
                    "to": "12-10-2020"
                },
                {
                    "from": "05-10-2020",
                    "to": "10-11-2020"
                },
                {
                    "from": "05-12-2020",
                    "to": "28-12-2020"
                }
            ]
        },
        {
            "name": "Media One Hotel",
            "price": 102.2,
            "city": "dubai",
            "availability": [
                {
                    "from": "10-10-2020",
                    "to": "15-10-2020"
                },
                {
                    "from": "25-10-2020",
                    "to": "15-11-2020"
                },
                {
                    "from": "10-12-2020",
                    "to": "15-12-2020"
                }
            ]
        },
        {
            "name": "Novotel Hotel",
            "price": 111,
            "city": "Vienna",
            "availability": [
                {
                    "from": "20-10-2020",
                    "to": "28-10-2020"
                },
                {
                    "from": "04-11-2020",
                    "to": "20-11-2020"
                },
                {
                    "from": "08-12-2020",
                    "to": "24-12-2020"
                }
            ]
        },
        {
            "name": "Rotana Hotel",
            "price": 80.6,
            "city": "cairo",
            "availability": [
                {
                    "from": "10-10-2020",
                    "to": "12-10-2020"
                },
                {
                    "from": "25-10-2020",
                    "to": "10-11-2020"
                },
                {
                    "from": "05-12-2020",
                    "to": "18-12-2020"
                }
            ]
        }
    ]
}
```

#### Available Output format

Output format available for one echoing data

| Name  | Description | Default | Example | 
| :---   | :---- | --- |:---- |
| json  | show results in output format. | json | output_format=json |

``
GET http://localhost/hotels-filters?output_format=json
``

##### Response
```json
{
    "data": [
        {
            "name": "Concorde Hotel",
            "price": 79.4,
            "city": "Manila",
            "availability": [
                {
                    "from": "10-10-2020",
                    "to": "19-10-2020"
                },
                {
                    "from": "22-10-2020",
                    "to": "22-11-2020"
                },
                {
                    "from": "03-12-2020",
                    "to": "20-12-2020"
                }
            ]
        },
        {
            "name": "Golden Tulip",
            "price": 109.6,
            "city": "paris",
            "availability": [
                {
                    "from": "04-10-2020",
                    "to": "17-10-2020"
                },
                {
                    "from": "16-10-2020",
                    "to": "11-11-2020"
                },
                {
                    "from": "01-12-2020",
                    "to": "09-12-2020"
                }
            ]
        },
        {
            "name": "Le Meridien",
            "price": 89.6,
            "city": "london",
            "availability": [
                {
                    "from": "01-10-2020",
                    "to": "12-10-2020"
                },
                {
                    "from": "05-10-2020",
                    "to": "10-11-2020"
                },
                {
                    "from": "05-12-2020",
                    "to": "28-12-2020"
                }
            ]
        },
        {
            "name": "Media One Hotel",
            "price": 102.2,
            "city": "dubai",
            "availability": [
                {
                    "from": "10-10-2020",
                    "to": "15-10-2020"
                },
                {
                    "from": "25-10-2020",
                    "to": "15-11-2020"
                },
                {
                    "from": "10-12-2020",
                    "to": "15-12-2020"
                }
            ]
        },
        {
            "name": "Novotel Hotel",
            "price": 111,
            "city": "Vienna",
            "availability": [
                {
                    "from": "20-10-2020",
                    "to": "28-10-2020"
                },
                {
                    "from": "04-11-2020",
                    "to": "20-11-2020"
                },
                {
                    "from": "08-12-2020",
                    "to": "24-12-2020"
                }
            ]
        },
        {
            "name": "Rotana Hotel",
            "price": 80.6,
            "city": "cairo",
            "availability": [
                {
                    "from": "10-10-2020",
                    "to": "12-10-2020"
                },
                {
                    "from": "25-10-2020",
                    "to": "10-11-2020"
                },
                {
                    "from": "05-12-2020",
                    "to": "18-12-2020"
                }
            ]
        }
    ]
}
```

## Console

In development progress.

## New Filter
Application allows you to add new filter.

#### Go to 

```
hotels-filters -> app -> filters
```

#### Create a new class

```php
<?php

namespace HotelsFilters\Filters;

use HotelsFilters\Contracts\FiltersContracts\AbstractFilter;

class NewFilterClass extends AbstractFilter
{
    /**
     * Name of filter
     */
    protected $filterName = 'new_filter_name';
    
    /**
     * Set Filter Value and apply any validation on it.
     */
    public function setFilterValue($value)
    {}
    
    /**
     * Apply Filter to data.
     */
    public function filterData(array $data): bool
    {}
}
```

##### Register the new class in FilterRepository

#### Go to 

```
hotels-filters -> app -> Repositories
```
#### Edit FilterRepository.php

```php
<?php
class FilterRepository
{
    protected $registeredFilters = [
        DateRangeFilter::class,
        DestinationFilter::class,
        HotelNameFilter::class,
        PriceRangeFilter::class,
        NewFilterClass::class // <-- Add New Filter
    ];
}
```
#### To use the new filter

``
GET http://localhost/hotels-filters?filters[new_filter_name]=value
``

## New Order
You may want to order data by new custom field than the defaults.

#### Go to 

```
hotels-filters -> app -> orders
```

#### Create a new class

```php
<?php
/**
 * Order By New Order field.
 *
 * Class HotelNameOrder
 * @package HotelsFilters\Orders
 */
class NewFieldOrder extends AbstractOrder
{
    /**
     * Order Name.
     *
     * @var string
     */
    protected $orderName = 'new_order_field';
}
```

##### Register the new class in OrderRepository

#### Go to 

```
hotels-filters -> app -> Repositories
```
#### Edit OrderRepository.php

```php
<?php
class OrderRepository
{
    protected $registeredOrders = [
        NameOrder::class,
        PriceOrder::class,
        NewFieldOrder::class // <-- Add New Order
    ];
}
```
#### To use the new order

``
GET http://localhost/hotels-filters?order_by=new_order_field&order_type=asc
``

## New Output format
Create New output format like html format or xml default is json.

#### Go to 

```
hotels-filters -> app -> Output
```

#### Create a new class

```php
<?php

namespace HotelsFilters\Output;

use HotelsFilters\Contracts\OutputFormat\AbstractOutputFormat;

class HtmlOutput extends AbstractOutputFormat
{
    /**
     * Format Name.
     *
     * @var string
     */
    protected $formatName = 'html';

    /**
     * Implement this method to output the results as html.
     *
     * @return string
     */
    public function output(): string
    {}

}
```

##### Register the new class in OutputRepository

#### Go to 

```
hotels-filters -> app -> Repositories
```
#### Edit OutputRepository.php

```php
<?php

class OutputRepository
{
    protected $registeredOutputFormats = [
        JsonOutput::class,
        HtmlOutput::class // <-- Add New output format
    ];
}
```
#### To use the new output format

``
GET http://localhost/hotels-filters?output_format=html
``

## PHP Docs

At app root directory Run

```bash
php vendor/bin/phpdoc -d app/ -t docs --title="Hotels Filters"
```

## Test Cases

To Run test cases. From app root directory

Run

```
php vendor/bin/phpunit 
```