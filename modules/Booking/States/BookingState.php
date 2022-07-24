<?php
namespace Ant\Booking\States;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class BookingState extends State
{
    use \Illuminate\Database\Eloquent\Concerns\HasAttributes;

    public static function config(): StateConfig
    {
        return parent::config()
            ->default(NewBooking::class)
            ->allowTransition(NewBooking::class, Booked::class)
        ;
    }

    public function getNameAttribute()
    {
        return class_basename($this);
    }

    /**
     * Dynamically retrieve attributes on the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->getAttribute($key);
    }

    /**
     * Dynamically set attributes on the model.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return void
     */
    public function __set($key, $value)
    {
        $this->setAttribute($key, $value);
    }
}