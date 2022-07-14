<?php
namespace Ant\Shopee\API;

class Logistics {
    public static function list($shopId = null) {
        $shopId = $shopId ?? config('shopee.shop_id');

        $data = static::__(app('shopee')->logistics()->getChannelList($shopId, [
        ]));
        return $data['response']['logistics_channel_list'];
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