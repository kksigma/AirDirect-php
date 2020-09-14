<?php

namespace VtDirect;

/**
 * Http要求のインターフェイス
 * Class HttpRequestInterface
 * @package VtDirect\Client
 */
interface HttpRequestInterface
{

    function SendGetRequest($url, $serverKey);

    function SendPostRequest($url, $serverKey, $requestBody);

}
