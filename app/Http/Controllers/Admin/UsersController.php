<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::paginate(18);
        
        return view('home',['users' => $users]);
    }

    /**
     * Show the user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        
        return view('profile',['user' => $user]);
    }

    /**
     * Page add new user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Save user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'email' => 'min:4|max:64|unique:users|required',
            'name' => 'min:4|max:64|required',
            'password' => 'min:6|max:64|required',
        ]);

        $result = User::create([
            'email' => $validate['email'],
            'name' => $validate['name'],
            'password' => bcrypt($validate['password']),
        ]);

        return redirect(route('admin.create'))->with('message', 'Data saved successfully!!');
    }

    /**
     * Delete user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function delete($id)
    {
        $user = User::findOrFail($id)->delete();

        return redirect(route('admin.users'))->with('message', 'Deleted successfully!!');
    }

    /**
     * Show profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile()
    {
        $user = Auth::user();

        return view('profile',['user' => $user]);
    }

}
