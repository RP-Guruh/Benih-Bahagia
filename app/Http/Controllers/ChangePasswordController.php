<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ChangePasswordController extends Controller
{
    public function index() {
        $user = User::find(Auth::id());
        return view('change-password.index', compact('user'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);

        if ($user->id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if (!Hash::check($request->current_password, $user->password)) {
            return Redirect::back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        Auth::logout();

        return redirect()->route('login')->with('alert', [
            'type'    => 'success',
            'title'   => 'Berhasil!',
            'message' => 'Password berhasil diperbarui. Silakan login ulang.',
        ]);
    }
}