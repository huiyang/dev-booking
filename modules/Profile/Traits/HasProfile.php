<?php
namespace Ant\Profile\Traits;

trait HasProfile
{
    public function profiles() {
        return $this->hasMany('Ant\Profile\Models\UserProfile', 'user_id');
    }

    public function profile() {
        return $this->hasOne('Ant\Profile\Models\UserProfile', 'user_id')->where('main_profile', 1);
    }
}