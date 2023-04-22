<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Profile page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index() {

        $user = Auth::user();

        return view('profile.profile', ['user' => $user]);
    }

    /**
     * Edit profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit()
    {
        $user = Auth::user();

        return view('profile.edit',['user' => $user]);
    }

    /**
     * Update profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        $validate = $request->validate([
            'email' => 'min:4|max:64|required|unique:users,email,'. $user->id,
            'name' => 'min:4|max:64|required',
            'password' => 'min:6|max:64',
            'img' => 'mimes:jpeg,jpg,png|max:10000',
        ]);

        if ($request->hasFile('img')) {
            $extension = $request->file('img')->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $image = $request->file('img')->move(storage_path('app/public/images'), $fileName);
            $validate['img'] = $fileName;
        }

        $validate['password'] = bcrypt($validate['password']);

        $result = $user->update($validate);

        if(Auth::user()->role == 'admin')
        {
            return redirect(route('admin.profile'))->with('message', 'Edit successfully!!');
        }
        else
        {
            return redirect(route('profile'))->with('message', 'Edit successfully!!');
        }
    }
}
