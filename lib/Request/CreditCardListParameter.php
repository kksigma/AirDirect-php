<?php

namespace VtDirect\Request;

/**
 * CreditCard/list APIにリクエストするパラメータをセットするクラス
 * Class CreditCardListParameter
 * @package VtDirect\Request
 */
class CreditCardListParameter
{
    /**
     * @var string Customer Id (必須)
     */
    public $customer_id;
}
