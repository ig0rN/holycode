<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordChangeRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showForm()
    {
        return view('auth.passwords.change');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PasswordChangeRequest $request)
    {
        $user = User::find( auth()->id() );
        $currentPassCheck = Hash::check(request( 'current-password'), $user->password );

        if( !$currentPassCheck ) {

            return redirect()->back()->with(['error' => 'Current Password is wrong. Please try again.']);

        }

        if( request( 'current-password') == request( 'new-password') ) {

            return redirect()->back()->with(['error' => 'Current Password can not be the same as New Password. Please try again.']);

        }

        $user->update([
            'password' => Hash::make(request('new-password'))
        ]);

        return redirect('/home')->with(['success' => 'You changed your password.']);
    }
}
