<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

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
        $user = User::find($id);
        
        return view('user',['user' => $user]);
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
     * @return void
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
}
