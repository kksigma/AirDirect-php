<?php

namespace VtDirect\Request;

/**
 * Capture APIにリクエストするパラメータをセットするクラス
 * Class CaptureParameter
 * @package VtDirect\Request
 */
class CaptureParameter
{
    /**
     * @var string 与信済み決済のOrder Id
     */
    public $order_id;

    /**
     * @var Integer 売上金額 未指定時は与信金額で売上する
     */
    public $amount;

}
