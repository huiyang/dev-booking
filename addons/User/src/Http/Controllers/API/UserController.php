<?php
namespace Addons\User\Http\Controllers\API;

use Fusion\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Addons\User\Facades\UserPage;
use App\Models\User;
use Fusion\Events\UserDeleted;
use Fusion\Http\Resources\UserResource;
use Fusion\Http\Requests\UserRequest;

class UserController extends Controller {
    public function index(Request $request, User $user) {
        return [
            'user' => $user,
            'tabs' => UserPage::getTabs(),
            'profile_label' => [
                'data.origin' => 'Place of Origin 来自哪里',
                'data.city' => 'Current City 长居城市',
                'data.language' => 'Languages 擅长与其他可沟通的语言',
                'data.speciality' => 'Strength / Specialities / Occupation 专长 / 专研领域 / 职业',
                'data.affiliation' => 'Affiliation 所属机构 / 社团',
                'data.interest' => 'Interest 兴趣',
                'data.readingPreference' => 'Reading Preference 想阅读的书类',
            ],
        ];
    }
    
    /**
     * Return the specific user.
     *
     * @param \Fusion\Models\User $user
     *
     * @return \Fusion\Http\Resources\UserResource
     */
    public function show(User $user)
    {
        $this->authorize('users.view');

        return new UserResource($user);
    }

    /**
     * Store a new user.
     *
     * @param \Fusion\Http\Requests\UserRequest $request
     *
     * @return \Fusion\Http\Resources\UserResource
     */
    public function store(UserRequest $request)
    {
        $attributes             = $request->validated();
        $attributes['password'] = bcrypt($attributes['password']);

        $user = User::create($attributes);

        // role assignment..
        if (isset($attributes['role'])) {
            if ($attributes['role'] === 'owner') {
                User::role('owner')
                    ->where('id', '<>', $user->id)
                    ->each(function ($user) {
                        $user->syncRoles('admin');
                    });
            }

            $user->assignRole($attributes['role']);
        }

        return new UserResource($user);
    }

    /**
     * Update an existing user.
     *
     * @param \Fusion\Http\Requests\UserRequest $request
     * @param \Fusion\Models\User               $user
     *
     * @return \Fusion\Http\Resources\UserResource
     */
    public function update(UserRequest $request, User $user)
    {
        $attributes = $request->validated();

        // password (optional)..
        if (isset($attributes['password'])) {
            $attributes['password'] = bcrypt($attributes['password']);
        }

        $user->update($attributes);

        // role assignment..
        if (isset($attributes['role'])) {
            if ($attributes['role'] === 'owner') {
                User::role('owner')
                    ->where('id', '<>', $user->id)
                    ->each(function ($user) {
                        $user->syncRoles('admin');
                    });
            }

            $user->syncRoles($attributes['role']);
        }

        return new UserResource($user);
    }

    /**
     * Destroy an existing user.
     *
     * @param \Fusion\Models\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('users.delete');

        event(new UserDeleted($user));

        $user->delete();
    }
}