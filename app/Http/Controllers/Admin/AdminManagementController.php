<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminManagementController extends Controller
{
    public function showPromotionForm()
    {
        $adminEmails = Admin::pluck('email')->toArray();

        $users = User::where('email', '!=', 'admin@admin.com')
                    ->whereNotIn('email', $adminEmails)
                    ->get();

        $adminUsers = User::whereIn('email', $adminEmails)->get();

        $usersCotisationDepense = User::all();

        return view('admin.dashboard', compact('users', 'adminUsers', 'adminEmails', 'usersCotisationDepense'));
    }


    public function promote(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Utilisateur introuvable.');
        }

        if (Admin::where('email', $user->email)->exists()) {
            return back()->with('error', 'Cet utilisateur est déjà un administrateur.');
        }

        Admin::create([
            'email' => $user->email,
            'password' => $user->password,
        ]);

        return back()->with('success', 'Utilisateur promu au rôle d’administrateur avec succès.');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins,email',
        ]);

        if ($request->email === 'admin@admin.com') {
            return back()->with('error', 'Impossible de supprimer l’administrateur principal.');
        }

        Admin::where('email', $request->email)->delete();

        return back()->with('success', 'L’utilisateur a été retiré du rôle d’administrateur.');
    }

}