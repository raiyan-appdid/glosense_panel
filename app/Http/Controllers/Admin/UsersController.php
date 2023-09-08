<?php

namespace App\Http\Controllers\Admin;

use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index(UsersDataTable $table)
    {
        $pageConfigs = ['has_table' => true,];
        // $table->with('id', 1);
        return $table->render('content.tables.users.users', compact('pageConfigs'));
    }
    public function store(Request $request)
    {
    }
    public function edit($id)
    {
        $name = User::findOrFail($id);
        return response($name);
    }

    public function update(Request $request)
    {
        // return $request->all();
        $users = $request->validate([
            'id' => 'required|numeric|exists:users,id',
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required',
            'phone' => 'required|min:10',
            'address' => 'required',
            'gender' => 'required'
        ]);
        // return $users;
        $user = User::find($request->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->save();
        return response([
            'header' => 'Updated!',
            'message' => $request->first_name . ' ' . $request->last_name . ' Updated successfully!',
            'table' => 'users-table',
        ]);
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:users,id',
            'status' => 'required|in:active,blocked',
        ]);

        User::findOrFail($request->id)->update(['status' => $request->status]);

        return response([
            'message' => 'users status updated successfully',
            'table' => 'users-table',
        ]);
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return response([
            'header' => 'Deleted!',
            'message' => 'users deleted successfully',
            'table' => 'users-table',
        ]);
    }
}
