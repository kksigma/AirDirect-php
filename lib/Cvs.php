<?php

namespace VtDirect;
use VtDirect\Request\CvsParameter;

require_once 'Setting.php';
require_once 'HttpRequestInterface.php';
require_once 'Request.php';
require_once 'CurlRequest.php';
require_once 'Request/CvsParameter.php';

/**
 * CVS APIにリクエストするクラス
 * Class Cvs
 * @package VtDirect\Client
 */
class Cvs extends Request
{
    private $_apiPath = "/vtdirect/v1/cvs";

    public function __construct(Setting $setting, HttpRequestInterface $httpRequest = null)
    {
        parent::__construct($this->_apiPath, $setting, $httpRequest, "post");
    }

    /**
     * CVS APIにリクエストを送信するメソッド
     * @param CvsParameter $cvsParameter
     * @return mixed Capture APIの応答結果JSONをデシリアライズしたオブジェクト
     */
    public function PaymentAtCvs(CvsParameter $cvsParameter)
    {
        $response = parent::Request($cvsParameter);
        return $response;
    }

}
