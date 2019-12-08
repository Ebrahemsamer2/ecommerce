<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\AdminRequest;

class AdminController extends Controller
{   
    public function __construct() {
        $this->middleware('issuper');
    }

    public function index()
    {   
        $admins = User::admins()->orderBy('id', 'desc')->paginate(20);
        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.admins.create');
    }
    
    public function store(AdminRequest $request, Admin $admin)
    {
        dd($admin);
        
        $admin->create($request->merge(['password' => Hash::make($request->get('password'))])->all());
        return redirect()->route('admins.index')->withStatus(__('Admin successfully created.'));
    }

    public function show(Admin $admin)
    {
        // 
    }

    public function edit(Admin $admin)
    {
        return view('admin.admins.edit', compact('admin'));
    }

    public function update(AdminRequest $request, Admin $admin)
    {
        $hasPassword = $request->get('password');
        $admin->update(
            $request->merge([
                'password' => Hash::make($request->get('password'))
                ])->except([$hasPassword ? '' : 'password'])
            );

        return redirect()->route('admins.index')->withStatus(__('Admin successfully updated.'));
    }

    public function destroy(Admin $admin)
    {
        $admin_image = $admin->image;
        if($admin_image) {
            if(file_exists('images/'.$admin_image->filename)){
                unlink('images/' . $admin_image->filename);
            }   
        }
        $admin->delete();
        return redirect('/admin/admins')->withStatus('Admin successfully Deleted');
    }
}
