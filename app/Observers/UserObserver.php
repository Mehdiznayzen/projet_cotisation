<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Admin;

class UserObserver
{
    public function updated(User $user): void
    {
        \Log::info('User updated observer triggered', ['user_id' => $user->id, 'email' => $user->email]);

        $admin = Admin::where('email', $user->getOriginal('email'))->first();

        if ($admin) {
            \Log::info('Admin found to update', ['admin_id' => $admin->id]);

            $admin->update([
                'email' => $user->email,
                'password' => $user->password,
            ]);
        } else {
            \Log::info('No matching admin found for email', ['email' => $user->getOriginal('email')]);
        }
    }
}
