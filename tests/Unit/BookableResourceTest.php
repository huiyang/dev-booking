<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\BookableResource;

class BookableResourceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testNewBooking()
    {
        $start = '2021-07-01 00:00:00';
        $end = '2021-07-03 00:00:00';

        $user = User::factory()->create();
		$resource = BookableResource::factory()->create();
        $booking = $resource->newBooking($user, $start, $end);

        $this->assertEquals($start, $booking->starts_at);
        $this->assertEquals($end, $booking->ends_at);
        $this->assertEquals('day', $resource->unit);
        $this->assertEquals($resource->unit_cost * 2, $booking->price);
    }

    public function testIsAvailableBetween()
    {
        $start = '2021-07-01 00:00:00';
        $end = '2021-07-03 00:00:00';

		$resource = BookableResource::factory()->create();
        $this->assertTrue($resource->isAvailableBetween($start, $end));
    }

    public function testIsAvailableBetweenForBooked()
    {
        $start = '2021-07-01 00:00:00';
        $end = '2021-07-03 00:00:00';

        $user = User::factory()->create();
		$resource = BookableResource::factory()->create(['quantity' => 1]);
        
        $booking = $resource->newBooking($user, $start, $end);
        $this->assertFalse($resource->isAvailableBetween($start, $end));
    }
}
