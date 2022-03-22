<?php
namespace Addons\User\Managers;

class UserPage {
    protected $tabs = [];

    public function registerTab($label, $componentName) {
        $key = $label.'-'.$componentName;
        $this->tabs[$key] = [
            'label' => $label,
            'order' => count($this->tabs),
            'component' => $componentName,
        ];
    }

    public function getTabs() {
        return collect($this->tabs)->sortBy('order');
    }
}