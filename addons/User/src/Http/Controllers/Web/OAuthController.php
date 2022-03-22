<?php
namespace Addons\User\Http\Controllers\Web;

use Socialite;
use Auth;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class OAuthController extends Controller {

    protected $redirectTo = '/';
    
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function redirect($provider)
    {
      return Socialite::driver($provider)->redirect();
    }
    
    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }

    public function callback($provider, Request $request) {
        try {
            if (!$request->has('code') || $request->has('denied')) {
                return redirect('login'); // redirect url
            }
            $userSocial = Socialite::driver($provider)->stateless()->user();
            $users = User::where(['email' => $userSocial->getEmail()])->first();

            if ($users) {
                Auth::login($users);
                return redirect()->intended($this->redirectPath());
                // return redirect('/');
            } else {
                $user = User::create([
                    'name'          => $userSocial->getName(),
                    'email'         => $userSocial->getEmail(),
                    'uuid'          => Str::uuid(),
                    'password' => Hash::make(Str::random(10)),
                ]);
                return redirect()->intended($this->redirectPath());
            }
        } catch(\Exception $e) {
            throw $e;
            // return redirect('login');
        }
    }
}