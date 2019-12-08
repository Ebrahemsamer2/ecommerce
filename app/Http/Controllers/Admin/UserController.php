<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function index(User $model)
    {
        return view('admin.users.index', ['users' => $model->users()->paginate(15)]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(UserRequest $request, User $model)
    {
        dd($model);
        $model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());
        return redirect()->route('users.index')->withStatus(__('User successfully created.'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $hasPassword = $request->get('password');
        $user->update(
            $request->merge([
                'password' => Hash::make($request->get('password'))
                ])->except([$hasPassword ? '' : 'password'])
            );

        return redirect()->route('users.index')->withStatus(__('User successfully updated.'));
    }

    public function destroy(User $user)
    {
        $user_image = $user->image;
        if($user_image) {
            if(file_exists('images/'.$user_image->filename)){
                unlink('images/' . $user_image->filename);
            }   
        }
        $user->delete();
        return redirect()->route('users.index')->withStatus(__('User successfully deleted.'));
    }
}
