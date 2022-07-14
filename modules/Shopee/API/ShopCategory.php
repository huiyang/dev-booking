<?php
namespace Ant\Shopee\API;

class ShopCategory {
    public static function list($offset = 0, $limit = 20, $shopId = null) {
        $shopId = $shopId ?? config('shopee.shop_id');

        return static::__(app('shopee')->shopCategory()->getShopCategoryList($shopId, [
            'page_no' => ($offset / $limit) + 1,
            'page_size' => $limit,
        ]));
    }

    protected function _($response) {
        return static::__($response);
    }

    protected static function __($response) {
        $data = $response;
        if (isset($data['error']) && $data['error']) {
            throw new \Exception($data['error'].': '.$data['message']);
        }
        return $data;
    }

    public function __get($name)
    {
        return $this->properties[$name] ?? null;
    }

    public function __set($name, $value)
    {
        return $this->properties[$name] = $value;
    }
}