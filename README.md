# HttpClient

This is a class for sending HTTP requests and receiving HTTP responses from a re
source identified by a URL.

This class abstracts the cURL, a PHP library and command-line tool (similar to wget) that allows you to send and receive files over HTTP and FTP. You can use proxies, pass data over SSL connections, set cookies, and even get files that are protected by a login.

## Requirements

To use this component, you must enable the curl extension in your php.ini file.

## How to Use

You must instantiate the class [HttpClient](src/Http/HttpClient.php) passing the url of the API as a parameter. Then you can request from the url passing the `request method` (must be in UPPERCASE and by default is GET), the headers, and the data as optional parameters.

```php
$url = 'https://myapi.com/v4.2/';

$client = new HttpClient($url);

$response = $client->request();
```

The request method throws an exception if an error occurs during its execution.

To enable ssl verification you need to access the ssl attribute and set it to true, e.g.

```php
$client->ssl = true;
```

## How to Install

You can clone the repository on your desktop or simply download the compressed file by clicking on Code and then Download ZIP.

```bash
git clone git@github.com:AssoDePicche/httpclient.git
```
