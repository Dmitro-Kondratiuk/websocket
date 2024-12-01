<?php

namespace App\Services;

use App\Data\UserData;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\LaravelData\DataCollection;

class UserService
{


    public function getFriends(): DataCollection
    {
        if (Auth::user()->subscribed_accounts === null) {
            return UserData::collect([], DataCollection::class);
        }
        return UserData::collect(User::whereIn('id', collect(Auth::user()->subscribed_accounts))->get(), DataCollection::class);
    }

    public function getPotentialFriends(DataCollection $friends): DataCollection
    {
        if ($friends->toCollection()->isEmpty()) {
            return UserData::collect([], DataCollection::class);
        }
        $cred = [[Auth::id()], Auth::user()->subscribed_accounts];
        return UserData::collect(User::whereNotIn('id', array_merge(...$cred))->get(), DataCollection::class);
    }

    public function addFried(User $newUser): void
    {
        $user = Auth::user();
        $subscribedAccounts = $user->subscribed_accounts ?? [];
        if (!in_array($newUser->id, $subscribedAccounts)) {
            $subscribedAccounts[] = $newUser->id;
        }
        $user->subscribed_accounts = $subscribedAccounts;
        $user->save();
    }
}
