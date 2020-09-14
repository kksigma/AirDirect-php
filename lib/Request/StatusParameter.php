<?php

namespace VtDirect\Request;

/**
 * Status APIにリクエストするパラメータをセットするクラス
 * Class StatusParameter
 * @package VtDirect\Request
 */
class StatusParameter
{
    /**
     * @var string 決済済みのOrder Id (必須)
     */
    public $order_id;
}
