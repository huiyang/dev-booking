<?php
namespace Ant\Shopee\Http\Controllers;

use Illuminate\Routing\Controller;

class ShopeePushSandboxController extends Controller {
    public function order() {
        $json = '{"data":{"items":[],"ordersn":"220714EUKJCDP2","status":"UNPAID","update_time":1657811484},"shop_id":20348703,"code":3,"timestamp":1657811484}';
        $webhook = url('shopee/webhooks');
        // $webhook = 'https://enoh1uxvwlguh.x.pipedream.net/';

        return view('api-sandbox', [
            'json' => $json,
            'url' => $webhook,
        ]);
    }
}