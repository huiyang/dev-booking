<?php

namespace Ant\Profile\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// use App\Models\Contact;
// use App\Models\Address;

class UserProfile extends Model
{
    use HasFactory;

    public $table = 'user_profile';

    protected $fillable = [
      'old_id',
      'user_id',
      'firstname',
      'lastname',
      'company',
      'contact_number',
      'email',
      'avatar_path',
      'avatar_base_url',
      'gender',
      'address_id',
      'main_profile',
      'company_website_url',
      'data',
      'nationality_id',
      'title',
      'contact_id'
    ];

    protected $casts = [
      'data' => 'array',
    ];

    // public function contact(){
    //   return $this->belongsTo(Contact::class, 'contact_id');
    // }

    // public function address(){
    //   return $this->belongsTo(Address::class, 'address_id');
    // }

}
