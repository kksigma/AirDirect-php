<?php

namespace VtDirect\Request;

/**
 * ReCharges APIにリクエストするパラメータをセットするクラス
 * Class ReChargesParameter
 * @package VtDirect\Request
 */
class ReChargesParameter
{
    /**
     * @var string マーチャントサイトで採番したOrder Id (必須)
     */
    public $order_id;
    /**
     * @var int 決済金額 (必須)
     */
    public $gross_amount;
    /**
     * @var bool 与信と同時に売上するかどうか 未指定の場合は与信のみ
     */
    public $with_capture;
    /**
     * @var string カード登録と紐づくRegister Id (必須)
     */
    public $register_id;
}
