<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Fusion\Models\Matrix;
use App\Models\BookableResource;
use Addons\Booking\Http\Resources\BookingResource;

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
        $this->assertFalse($resource->isAvailableBetween('2021-07-01 12:00:00', '2021-07-02 12:00:00'));
    }

    public function testIsAvailableBetweenForExcludingBooked()
    {
        $start = '2021-07-01 00:00:00';
        $end = '2021-07-03 00:00:00';

        $user = User::factory()->create();
		$resource = BookableResource::factory()->create(['quantity' => 1]);
        
        $booking = $resource->newBooking($user, $start, $end);
        $this->assertTrue($resource->isAvailableBetween($start, $end, [$booking->id]));
    }

    public function testIsAvailableBetweenWithMinimumGap()
    {
        $start = '2021-07-01 02:00:00';
        $end = '2021-07-01 03:00:00';

        $user = User::factory()->create();
		$resource = BookableResource::factory()->create(['quantity' => 1]);
        
        $booking = $resource->newBooking($user, $start, $end);
        
        $this->assertTrue($resource->isAvailableBetween('2021-07-01 03:00:00', '2021-07-01 04:00:00')); // Should it true?
        $this->assertTrue($resource->isAvailableBetween('2021-07-01 03:01:00', '2021-07-01 04:00:00'));
        $this->assertTrue($resource->isAvailableBetween('2021-07-01 03:01:00', '2021-07-01 04:00:00', [], 60)); // Should it true?

        $this->assertFalse($resource->isAvailableBetween('2021-07-01 03:01:00', '2021-07-01 04:00:00', [], 61));
        $this->assertFalse($resource->isAvailableBetween('2021-07-01 03:00:00', '2021-07-01 04:00:00', [], 1));
    }

    public function testInvalidEndTime()
    {
        $start = '2021-07-01 00:00:00';
        $end = '2021-07-01 00:00:00';

        $user = User::factory()->create();
		$resource = BookableResource::factory()->create(['quantity' => 1]);
        
        $this->expectException(\Exception::class);

        $booking = $resource->newBooking($user, $start, $end);
    }

    public function testState()
    {
        $start = '2021-07-01 00:00:00';
        $end = '2021-07-03 00:00:00';

        $user = User::factory()->create();
        $matrix = Matrix::factory()->withBlueprint()->create();
		$resource = BookableResource::factory()->create(['quantity' => 1]);
        
        $booking = $resource->newBooking($user, $start, $end);
        
        $this->assertEquals(\Ant\Booking\States\NewBooking::class, $booking->state->getValue());

        $model = \Fusion\Services\Builders\Matrix::resolve($matrix->handle);
        $booking->updateBookingDetail($model);

        $this->assertEquals(\Ant\Booking\States\Booked::class, $booking->state->getValue());
    }
}
