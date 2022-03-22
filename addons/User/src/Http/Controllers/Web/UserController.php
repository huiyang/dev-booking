<?php
namespace Addons\User\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller {
    public function edit(Request $request) {
        $user = auth()->user();
        return view('user.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request) {
        $user = auth()->user();
        $validated = $request->validate([
            'name' => 'required',
        ]);
        $user->update($validated);

        flash()->success('User profile updated.');

        return redirect()->route('user.edit');
    }

    public function updatePassword(Request $request) {
        $user = auth()->user();
        
        $request->validate([
            'current_password' => ['required', new \Addons\User\Rules\CheckPassword],
            'new_password' => ['required', 'confirmed'],
        ]);

        auth()->user()->update(['password'=> Hash::make($request->new_password)]);

        flash()->success('Password updated.');

        return redirect()->route('user.edit');
    }
}