<?php

namespace VtDirect;
use VtDirect\Request\CancelParameter;

require_once 'Setting.php';
require_once 'HttpRequestInterface.php';
require_once 'Request.php';
require_once 'CurlRequest.php';
require_once 'Request/CancelParameter.php';

/**
 * Void APIにリクエストするクラス
 * Class Cancel
 * @package VtDirect\Client
 */
class Cancel extends Request
{
    private $_apiPath = "/vtdirect/v1/void";

    public function __construct(Setting $setting, HttpRequestInterface $httpRequest = null)
    {
        parent::__construct($this->_apiPath, $setting, $httpRequest, "post");
    }

    /**
     * Void APIにリクエストを送信するメソッド
     * @param CancelParameter $cancelParameter
     * @return mixed APIの応答結果JSONをデシリアライズしたオブジェクト
     */
    public function CancelOrder(CancelParameter $cancelParameter)
    {
        $response = parent::Request($cancelParameter);
        return $response;
    }
}
