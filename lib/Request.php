<?php

namespace VtDirect;

/**
 * VT-Direct APIにリクエストするための基底クラス。
 * 各APIごとに本クラスを継承したクラスを用意すること。
 * Class Request
 * @package VtDirect\Client
 */
abstract class Request
{
    private $_serverKey;
    private $_apiPath;
    private $_host;
    private $_https;
    private $_port;
    private $_method;
    private $_httpRequest;

    /**
     * @param string $apiPath APIのパス
     * @param Setting $setting Settingクラスのインスタンス
     * @param HttpRequestInterface $httpRequest
     * @param string $method get,post,put,deleteなど
     */
    public function __construct($apiPath, Setting $setting, HttpRequestInterface $httpRequest = null, $method = "post")
    {
        if ($httpRequest == null) $httpRequest = new CurlRequest(
            $setting->GetSslVerifyEnabled(), $setting->GetCACertPath(), Setting::VERSION);
        $this->_httpRequest = $httpRequest;
        $this->_serverKey = $setting->GetServerKey();
        $this->_apiPath = $apiPath;
        $this->_host = $setting->GetRequestHost();
        $this->_https = $setting->GetHttpsRequestEnabled();
        $this->_port = $setting->GetRequestPort();
        $this->_method = $method;
    }

    /**
     * @param $path string APIのパス
     * @return string APIのURL
     */
    public function GenerateApiUrl($path)
    {
        if (preg_match('/\A\//', $path) == 0) {
            $path = "/" . $path;
        }

        if (preg_match('/\/\z/', $path) == 1) {
            $path = rtrim($path, "/");
        }
        $path = ($this->_https ? "https://" : "http://") . $this->_host . ":" . (string)$this->_port . $path;
        return $path;
    }

    /**
     * @param $input mixed JSONシリアライズ可能なリクエストパラメータクラスのインスタンス
     * @return mixed VTDirectからの応答結果JSONをデシリアライズしたオブジェクト
     * @throws VtDirectException JSONデシリアライズに失敗したときや、不明なHttpMethodを指定されたときに投げられる例外
     */
    protected function Request($input)
    {
        $url = $this->GenerateApiUrl($this->_apiPath);
        $url = $this->GenerateAbsoluteApiUri($url, $input);

        switch (strtolower($this->_method)) {
            case "get" :
            case "delete":
                $response = $this->_httpRequest->SendGetRequest($url, $this->_serverKey);
                $responseObject = json_decode($response, true);
                $canDecode = json_last_error();
                if ($canDecode == JSON_ERROR_NONE) {
                    return $responseObject;
                } else {
                    throw new VtDirectException("Could not decode from JSON to php object. -> \r\n" . $response,
                        json_last_error());
                }
                break;
            case "post" :
            case "put" :
                $response = $this->_httpRequest->SendPostRequest($url, $this->_serverKey, $this->GetRequestBody($input));
                $responseObject = json_decode($response, true);
                $canDecode = json_last_error();
                if ($canDecode == JSON_ERROR_NONE) {
                    return $responseObject;
                } else {
                    throw new VtDirectException("Could not decode from JSON to php object. -> \r\n" . $response,
                        json_last_error());
                }
                break;
            default:
                throw new VtDirectException("The unexpected method was specified. -> " . $this->_method, -1);
        }
    }

    /**
     * @param $url string APIのURL
     * @param $input mixed JSONシリアライズ可能なリクエストパラメータクラスのインスタンス
     * @return string APIのURLに必要なGET引数や追加パラメータが連結されたURL
     */
    protected function GenerateAbsoluteApiUri($url, $input)
    {
        return $url;
    }

    /**
     * @param $input mixed JSONシリアライズ可能なリクエストパラメータクラスのインスタンス
     * @return string $inputをシリアライズしたJSON文字列
     * @throws VtDirectException シリアライズに失敗した場合に投げられる例外
     */
    protected function GetRequestBody($input)
    {
        $json = json_encode($input);
        if (json_last_error() != JSON_ERROR_NONE) {
            throw new VtDirectException("Could not encode to JSON.", json_last_error());
        }
        return $json;
    }

}
