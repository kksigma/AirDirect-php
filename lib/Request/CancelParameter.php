<?php

namespace VtDirect\Request;

/**
 * Void APIにリクエストするパラメータをセットするクラス
 * Class CancelParameter
 * @package VtDirect\Request
 */
class CancelParameter
{
    /**
     * @var string 決済済みのOrder Id (必須)
     */
    public $order_id;


    /**
     * @var Integer カードキャンセル金額 未指定時は全額キャンセル
     */
    public $amount;

}
