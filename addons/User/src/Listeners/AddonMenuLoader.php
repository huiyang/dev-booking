<?php

namespace Addons\User\Listeners;

use Menu;

class AddonMenuLoader
{
    public function handle()
    {
        $menu = Menu::get('admin');

        $menu->all()->map(function($item, $index) {
            $position = $item->data('position');
            if (!isset($position)) {
                $item->data('position', $index);
            }
        });
        $item = $menu->add('User List')->data([
            'position' => 0,
            'to'    => '/user-list',
            'icon'  => 'grip-horizontal',
        ]);

        $menu->sortBy('position');
    }
}
