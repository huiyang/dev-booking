<?php
namespace Addons\Subscription\Http\Controllers\API;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Addons\User\Facades\UserPage;
use App\Models\User;
use Ant\Subscription\Models\SubscriptionPackage;

class SubscriptionController extends Controller {

	public function subscription(Request $request, User $user) {
		
		$sub = SubscriptionPackage::with('subscriptionItems')->get();
		$user->isMember = $user->isMember();
		$user->memberExpiryDate = date( 'Y-m-d H:i:s', strtotime( $user->getMembershipExpireAtAttribute() ));
		
        return [
            'user' => $user,
            'tabs' => UserPage::getTabs(),
            'subs' => $sub,
        ];
    }
	
	public function extendSubcription(Request $request, User $user)
	{
		$bundle = $user->subscribeMembershipPackage( $request->packageid );
		$bundle->markAsPaid();
	}
}