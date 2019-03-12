# Laravel API Wrapper for Loqate / PCA Predict (formerly Postcode Anywhere)

[![Build Status](https://travis-ci.org/alexpechkarev/postcode-anywhere.svg?branch=master)](https://travis-ci.org/alexpechkarev/postcode-anywhere)

This wrapper simplifies process of making API calls to [**Loqate**](https://www.loqate.com/en-gb/)  web services down to a single line of code within your [**Laravel**](http://laravel.com/) application!

## Dependency
This package requires the [**PHP cURL**](http://php.net/manual/en/curl.installation.php) extension to be installed on your system.

## Contents

- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Support](#support)
- [License](#license)

## Installation
<a id="installation"></a>

Pull in the package using Composer

    composer require alexpechkarev/postcode-anywhere

> **Note**: If you are using Laravel 5.5, the next steps are unnecessary. This package supports Laravel [Package Discovery](https://laravel.com/docs/5.5/packages#package-discovery).

Include the service provider within `config/app.php`.

```php
'providers' => [
    ...
    PostcodeAnywhere\PAServiceProvider,
],
```

Include the facade within `config/app.php`.

```php
'aliases' => [
    ...
    'PA' => PostcodeAnywhere\PAFacade::class,
]
```

## Configuration
<a id="configuration"></a>

This package supports configuration.

You can publish the config file with:

```bash
php artisan vendor:publish --provider="PostcodeAnywhere\PAServiceProvider" --tag="config"
```

When published, [the `config/postcodeanywhere.php` config file](https://github.com/alexpechkarev/postcode-anywhere/blob/master/src/config/postcodeanywhere.php) contains:

```php
<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default parameters
    |--------------------------------------------------------------------------
    |
    | Service key - required
    | The key to use to authenticate to the service
    | String  - AA11-AA11-AA11-AA11
    */

    'params' => [
        'key' => env('PCA_KEY', 'AA11-AA11-AA11-AA11'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Service URL
    |--------------------------------------------------------------------------
    */

    'url' => 'https://services.postcodeanywhere.co.uk/',

    /*
    |--------------------------------------------------------------------------
    | Registered Web Services
    |--------------------------------------------------------------------------
    | @see http://www.postcodeanywhere.co.uk/support/webservices/
    */

    'services' => [
        'find' => [
            // PostcodeAnywhere Interactive RetrieveBySortcode (v1.00)
            'BankAccountValidation' => 'BankAccountValidation/Interactive/RetrieveBySortcode/v1.00/',

            // PostcodeAnywhere Interactive Find (v1.10)
            'PAInteractiveFind' => 'PostcodeAnywhere/Interactive/Find/v1.10/',

            // PostcodeAnywhere Interactive FindByPostcode (v1.00)
            'FindByPostcode' => 'PostcodeAnywhere/Interactive/FindByPostcode/v1.00/',

            // CapturePlus Interactive Find (v2.10)
            'CPInteractiveFind' => 'CapturePlus/Interactive/Find/v2.10/',

            // PostcodeAnywhere Interactive FindByAreaId (v1.00)
            'FindByAreaId' => 'PostcodeAnywhere/Interactive/FindByAreaId/v1.00/',

            // PostcodeAnywhere Interactive FindByBuilding (v1.00)
            'FindByBuilding' => 'PostcodeAnywhere/Interactive/FindByBuilding/v1.00/',

            // PostcodeAnywhere Interactive FindByLocalityId (v1.00)
            'FindByLocalityId' => 'PostcodeAnywhere/Interactive/FindByLocalityId/v1.00/',

            // PostcodeAnywhere Interactive FindByOrganisation (v1.00)
            'FindByOrganisation' => 'PostcodeAnywhere/Interactive/FindByOrganisation/v1.00/',

            // PostcodeAnywhere Interactive FindByPartialPostcode (v1.00)
            'FindByPartialPostcode' => 'PostcodeAnywhere/Interactive/FindByPartialPostcode/v1.00/',

            // PostcodeAnywhere Interactive FindByParts (v1.00)
            'FindByParts' => 'PostcodeAnywhere/Interactive/FindByParts/v1.00/',

            // PostcodeAnywhere Interactive FindByPoBox (v1.00)
            'FindByPoBox' => 'PostcodeAnywhere/Interactive/FindByPoBox/v1.00/',

            // PostcodeAnywhere Interactive FindByStreet (v1.00)
            'FindByStreet' => 'PostcodeAnywhere/Interactive/FindByStreet/v1.00/',

            // PostcodeAnywhere Interactive FindByStreetId (v1.00)
            'FindByStreetId' => 'PostcodeAnywhere/Interactive/FindByStreetId/v1.00/',

            // PostcodeAnywhere Interactive FindStreets (v1.00)
            'FindStreets' => 'PostcodeAnywhere/Interactive/FindStreets/v1.00/',

            // PostcodeAnywhere Interactive ListAliases (v1.10)
            'ListAliases' => 'PostcodeAnywhere/Interactive/ListAliases/v1.10/',

            // PostcodeAnywhere Interactive ListAreas (v1.00)
            'ListAreas' => 'PostcodeAnywhere/Interactive/ListAreas/v1.00/',

            // PostcodeAnywhere Interactive ListCounties (v1.00)
            'ListCounties' => 'PostcodeAnywhere/Interactive/ListCounties/v1.00/',
        ],
        'retrieve' => [
            // PostcodeAnywhere Interactive RetrieveById (v1.30)
            'RetrieveById' => 'PostcodeAnywhere/Interactive/RetrieveById/v1.30/',

            // PostcodeAnywhere Interactive RetrieveByAddress (v1.20)
            'RetrieveByAddress' => 'PostcodeAnywhere/Interactive/RetrieveByAddress/v1.20/',

            // CapturePlus Interactive Retrieve (v2.10)
            'CPInteractiveRetrieve' => 'CapturePlus/Interactive/Retrieve/v2.10/',

            // PostcodeAnywhere Interactive RetrieveByIdWithEmail (v1.20)
            'RetrieveByIdWithEmail' => 'PostcodeAnywhere/Interactive/RetrieveByIdWithEmail/v1.20/',

            // PostcodeAnywhere Interactive RetrieveByParts (v1.00)
            'RetrieveByParts' => 'PostcodeAnywhere/Interactive/RetrieveByParts/v1.00/',

            // PostcodeAnywhere Interactive RetrieveByPostcodeAndBuilding (v1.30)
            'RetrieveByPostcodeAndBuilding' => 'PostcodeAnywhere/Interactive/RetrieveByPostcodeAndBuilding/v1.30/',

            // PostcodeAnywhere Interactive RetrieveChanges (v1.00)
            'RetrieveChanges' => 'PostcodeAnywhere/Interactive/RetrieveChanges/v1.00/',

            // PostcodeAnywhere Interactive RetrieveHistoryById (v1.00)
            'RetrieveHistoryById' => 'PostcodeAnywhere/Interactive/RetrieveHistoryById/v1.00/',

        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | End point
    |--------------------------------------------------------------------------
    */

    'endpoint' => [
        'xml' => 'xmle.ws?',
        'xmla' => 'xmla.ws?',
        'json' => 'json.ws?',
        'jsonp' => 'json2.ws?',
        'json3' => 'json3.ws?',
        'json extra' => 'json3ex.ws?',
        'csv' => 'csv.ws?',
        'tsv' => 'tsv.ws?',
        'dataset' => 'dataset.ws?',
        'recordset' => 'recordset.ws?',
        'htmltable' => 'htmltable.ws?',
        'image' => 'image.ws?',
        'pdf' => 'pdf.ws?',
        'psv' => 'psv.ws?',
    ],
];
```

The configuration file has a multidimensional array called 'services' that defines web services by type; 'find' and 'retrieve'.

Feel free to add / remove any other Loqate / PCA Predict Services. 


## Usage
<a id="usage"></a>

Here is an example of making call to find address records for the given postcode. 

Within your application call `\PA::getResponse( array $param )` with array of parameters. 

```php
$param = [
    'action' => 'Web Service',
    'parameters' => 'array of parameters for Web Service called'
];
```

Example:
```php
$param = [
    'find' => 'FindByPostcode', // perform 'find' action calling 'FindByPostcode' web service 
    'param' => ['postcode'=>'SW1A 1AA', 'endpoint'=>'json'] // parameters for web service called
];
```

Note: defaulted to `json` when `endpoint` parameter ommited.

For more information, please see Loqate's API documentation [***PostcodeAnywhere Interactive FindByPostcode (v1.00)***](http://www.postcodeanywhere.co.uk/support/webservice/postcodeanywhere/interactive/findbypostcode/1/) for required parameters and response.

```php
$response = \PA::getResponse( $param );
```

Here is another example of retrieving full address details based on the ID. 

```php
$param = [
    'retrieve'=>'RetrieveById', 
        'param'=>['id'=>'23747212.00'] 
];

$response = \PA::getResponse( $param );
```
For more information, please see Loqate's API documentation  [***PostcodeAnywhere Interactive RetrieveById (v1.30)***](http://www.postcodeanywhere.co.uk/support/webservice/postcodeanywhere/interactive/retrievebyid/1.3/) for required parameters and response.

## Support
<a id="support"></a>

If you find an error or have any suggestions, please [open an issue on GitHub](https://github.com/alexpechkarev/postcode-anywhere/issues)

## License
<a id="license"></a>

Laravel API wrapper for Loqate / PCA Predict (formerly Postcode Anywhere) is released under the MIT License. See the bundled [LICENSE](https://github.com/alexpechkarev/postcode-anywhere/blob/master/LICENSE) file for details.
