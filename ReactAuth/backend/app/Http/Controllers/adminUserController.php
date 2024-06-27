<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class adminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $users = User::with('roles')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        
        if ($request->action === 'updateRole') {
            $roleId = $request->role_id;
            $role = Role::findOrFail($roleId);
            $user = User::findOrFail($id);
            $user->roles()->sync([$roleId]);
            $user->role = $role->name; 
            $user->save(); 
            return response()->json(['message' => 'Role updated successfully'], 200);
        }
        if ($request->action === 'updateUser') {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:255',
                'password' => 'nullable|string|min:8|confirmed',
                'profile_pic' => 'nullable|image|max:2048', // Max file size is 2MB
            ]);
            $user = User::findOrFail($id);
            if ($user->profile_pic && $request->hasFile('profile_pic')) {
                Storage::disk('public')->delete($user->profile_pic);
            }
            $user->name = $validatedData['name'];
            $user->telephone = $validatedData['phone'];
            if (!empty($validatedData['password'])) {
                $user->password = Hash::make($validatedData['password']);
            }
            if ($request->hasFile('profile_pic')) {
                $imagePath = $request->file('profile_pic')->store('profile_pics', 'public');
                $user->profile_pic = $imagePath;
            }
            $user->save();
            return response()->json(['message' => 'User updated successfully']);
        }
    }


    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id){
        $user = User::findOrFail($id);
        $user->roles()->detach();
        $user->delete();   
        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
