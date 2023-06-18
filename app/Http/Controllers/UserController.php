<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json([
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usersData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        $usersData['name'] = strip_tags($usersData['name']);
        $usersData['email'] = strip_tags($usersData['email']);
        $usersData['password'] = strip_tags($usersData['password']);
        $usersData['role'] = strip_tags($usersData['role']);

        $user = User::create($usersData);
        
        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $usersData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        $usersData['name'] = strip_tags($usersData['name']);
        $usersData['email'] = strip_tags($usersData['email']);
        $usersData['password'] = strip_tags($usersData['password']);
        $usersData['role'] = strip_tags($usersData['role']);

        $user->update($usersData);
        
        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'message' => 'User has been deleted'
        ]);
    }

    public function sendNotification(Request $request)
    {
        $recipientId = $request->input('recipient_id');
        $notificationContent = $request->input('content');

        $user = User::findOrFail($recipientId);

        $user->notify(new CustomNotification($notificationContent));

        return response()->json(['message' => 'Notification sent successfully']);
    }
}
