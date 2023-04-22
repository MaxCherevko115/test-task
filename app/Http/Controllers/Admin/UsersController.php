<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Storage;

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
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        
        return view('user',['user' => $user]);
    }

    /**
     * Page add new user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('admin.create');
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
            'img' => 'mimes:jpeg,jpg,png|required|max:10000',
        ]);

        if ($request->hasFile('img')) {
            $extension = $request->file('img')->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $image = $request->file('img')->move(storage_path('app/public/images'), $fileName);
            $validate['img'] = $fileName;
        }

        $result = User::create([
            'email' => $validate['email'],
            'name' => $validate['name'],
            'password' => bcrypt($validate['password']),
            'img' => $validate['img'],
        ]);

        return redirect(route('admin.users'))->with('message', 'User added!!');
    }

    /**
     * Delete user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function delete(string $id)
    {
        $user = User::findOrFail($id);

        if(Storage::exists('public/images')){
            Storage::delete("public/images/{$user->img}");
        }

        $user->delete();

        return redirect(route('admin.users'))->with('message', 'Deleted successfully!!');
    }

    /**
     * Edit page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('admin.edit', compact('user'));
    }

    /**
     * Update user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validate = $request->validate([
            'email' => 'min:4|max:64|required|unique:users,email,'. $id,
            'name' => 'min:4|max:64|required',
            'password' => 'min:6|max:64|required',
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

        return redirect(route('admin.edit', $id))->with('message', 'Edit successfully!!');
    }

    /**
     * Make user admin.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function role(string $id)
    {
        $user = User::findOrFail($id);

        $result = $user->update(['role' => '1']);

        return redirect()->back()->with('message', 'The user become an admin!!');
    }

}
