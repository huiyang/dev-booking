<?php
namespace Addons\User\Http\Controllers\DataTable;

use Illuminate\Routing\Controller;
use Addons\User\Facades\UserPage;
use App\Models\User;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Database\Eloquent\Builder;

class UserController extends \Fusion\Http\Controllers\DataTable\UserController {
    public function builder()
    {
        if (request()->route('role')) {
            return User::whereHas('roles', function ($query) {
                $query->where('name', request()->route('role'));
            });
        } else {
            return User::query();
        }
    }

    public function getAllowedAppends()
    {
        return ['name', 'contactNumber', 'identityCardNumber', 'isMember', 'membershipExpireAt'];
    }

    public function getDisplayableColumns()
    {
        return [
            'id',
            'username',
            'name',
            'email',
            'membership',
            // 'role',
        ];
    }

    public function getSortable()
    {
        return [
            'id',
            'name',
            'username',
            'email',
            'created_at',
        ];
    }

    public function getFilterable()
    {
        return [
            'username',
            'email',
        ];
    }

    protected function getAllowedFilters()
    {
        return AllowedFilter::callback('search', function (Builder $query, $value) {
            return $query->searchByFilterableWithChinese($this->getFilterable(), $value);
        });
    }
}