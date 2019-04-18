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
