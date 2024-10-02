<?php

namespace App\Http\Controllers\merchant;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pages.merchant.profile.index');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), ([
            'name' => 'required',
            'contact' => 'min:11|max:13',
            'address' => 'max:255',
            'description' => 'max:255',
        ]));

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $user = User::find(Auth::user()->id);
        $user->update($request->all());


        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
