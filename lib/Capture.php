<?php

namespace VtDirect;
use VtDirect\Request\CaptureParameter;

require_once 'Setting.php';
require_once 'HttpRequestInterface.php';
require_once 'Request.php';
require_once 'CurlRequest.php';
require_once 'Request/CaptureParameter.php';

/**
 * Capture APIにリクエストするクラス
 * Class Capture
 * @package VtDirect\Client
 */
class Capture extends Request
{
    private $_apiPath = "/vtdirect/v1/capture";

    public function __construct(Setting $setting, HttpRequestInterface $httpRequest = null)
    {
        parent::__construct($this->_apiPath, $setting, $httpRequest, "post");
    }

    /**
     * Capture APIにリクエストを送信するメソッド
     * @param CaptureParameter $captureParameter
     * @return mixed Capture APIの応答結果JSONをデシリアライズしたオブジェクト
     */
    public function CaptureOrder(CaptureParameter $captureParameter)
    {
        $response = parent::Request($captureParameter);
        return $response;
    }


}
