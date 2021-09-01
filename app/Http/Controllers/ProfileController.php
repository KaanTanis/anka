<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function edit()
    {
        if (\request()->isMethod('post')) {
            \request()->validate([
                'old_password' => 'required',
                'new_password' => 'required|confirmed'
            ], [
                'old_password.required' => __('Old password is required'),
                'new_password.required' => __('New password is required'),
                'new_password.confirmed' => __('New password doesn\'t match')
            ]);

            if (! Hash::check(\request()->new_password, auth()->user()->password)) {
                return back()->with(['status' => 'danger', 'message' => __('Your old password is wrong! Please check again.')]);
            } else {
                User::find(auth()->id())->update([
                    'password' => Hash::make(\request()->new_password)
                ]);

                return back()->with(['status' => 'success', 'message' => __('Your password was successfully updated!')]);
            }
        }

        return view('admin.profile');
    }
}
