<?php

namespace Ant\Shopee\Listeners;

use Ant\Shopee\Events\ShopeeOrderStatusUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class WebhookListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
        switch ($event->data['code']) {
            case 3:
                event(new ShopeeOrderStatusUpdated($event->data));
                break;
        }
    }
}
