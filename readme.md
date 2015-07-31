# Laravel API wrapper for PCA Predict formerly Postcode Anywhere

This wrapper simplifies process of making API calls to [**PostcodeAnywhere**](http://www.postcodeanywhere.co.uk/)  web services.
Single line of code within your [**Laravel**](http://laravel.com/) application that's all it takes.


Dependency
------------
[**PHP cURL**] (http://php.net/manual/en/curl.installation.php) required


Installation
------------

To install edit `composer.json` by adding following line and issue `composer update` command in console.

```javascript
"alexpechkarev/postcode-anywhere": "dev-master"
```


Configuration
-------------

Once installed, register Laravel service provider, in your `config/app.php`:

```php
'providers' => [
	...
    'Alexpechkarev\PostcodeAnywhere\PAServiceProvider',
]

'aliases' => [
	...
    'PA' => 'Alexpechkarev\PostcodeAnywhere\PAFacade' ,
]
```

In console issue following command to publish configuration file `php artisan vendor:publish` .
To access the services do not forget to update the service key in configuration file. 

Configuration file have multidimensional array 'services' that defines web services by type 'find' and 'retrieve' and store each services request path. Fill free to add / remove any other PCA Predict services. 

Usage
-----
Here is an example of making call to find address records for the given postcode. 
API documentation [***PostcodeAnywhere Interactive FindByPostcode (v1.00)***](http://www.postcodeanywhere.co.uk/support/webservice/postcodeanywhere/interactive/findbypostcode/1/).

Within your application call `\PA::getResponse()` with array of parameters. 

Where:
- 'find' is performing action
- 'FindByPostcode' is a web service as per config file
- 'param' - is array of parameters required for web service. (see [***API documentation***] (http://www.postcodeanywhere.co.uk/support/webservice/postcodeanywhere/interactive/findbypostcode/1/))
- 'endpoint' - is optional parameter defining type of response. When omitted defaults to `json`.

```php
$response = \PA::getRespose(['find'=>'FindByPostcode', 'param'=>['postcode'=>'SW1A 1AA', 'endpoint'=>'json'] ]);
```

Here is another example of retrieving full address details based on the id. 
API documentation [***PostcodeAnywhere Interactive RetrieveById (v1.30)***](http://www.postcodeanywhere.co.uk/support/webservice/postcodeanywhere/interactive/retrievebyid/1.3/)

Where:
- 'retrieve' is performing action
- 'RetrieveById' is a web service as per config file
- 'param' - is array of parameters required for web service. (see [***API documentation***] (http://www.postcodeanywhere.co.uk/support/webservice/postcodeanywhere/interactive/retrievebyid/1.3/)

```php
$response = \PA::getRespose(['retrieve'=>'RetrieveById', 'param'=>['id'=>'23747212.00'] ]);
```



Support
-------

[Found errors or to suggest improvements please open an issue on GitHub](https://github.com/alexpechkarev/postcode-anywhere/issues)


License
-------

Laravel API wrapper for PCA Predict formerly Postcode Anywhere is released under the MIT License. See the bundled
[LICENSE](https://github.com/alexpechkarev/postcode-anywhere/blob/master/LICENSE)
file for details.
