<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends \Fusion\Models\User
{
    use HasFactory, Notifiable;
    use \Ant\Member\Traits\IsMember;
    use \Ant\Profile\Traits\HasProfile;
    use \Rinvex\Bookings\Traits\HasBookings;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
	
	protected $appends = [
        'isMember',
		// 'membershipExpireAt'
		'formattedMembershipExpireAt'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime:Y-m-d H:i:s',
    ];

	public static function getBookingModel() {
		
	}
}
