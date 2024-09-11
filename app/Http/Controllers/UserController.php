<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\User;

use Illuminate\Http\Request;




class UserController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        return view('users.index');
    }
    
    public function insc()
    {
        return view('users.insc');
    }
    

    public function afterlogin(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Retrieve the email and password from the request
        $email = $request->input('email');
        $password = $request->input('password');
    
        // Query the database to check if the email and password exist
        $user = DB::table('userss')
            ->where('email', $email)
            ->where('password', $password)
            ->first();
    
        if ($user ) {
            if ($user->role == 'user') {
                session([
                    'user_id' => $user->user_id,
                    'user_name' => $user->firstname,
                    'user_lastname' => $user->lastname,
                ]);
                return redirect()->route('product.index'); // Redirect to teacher dashboard
            } elseif ($user->role == 'Admin') {
                session([
                    'user_id' => $user->user_id,
                    'user_name' => $user->firstname,
                    'user_lastname' => $user->lastname,
                ]);
                return redirect()->route('product.create'); // Redirect to student dashboard
            }
        } else {
            // Authentication failed, redirect back with an error message
            return redirect()->route('user.index')->with('error', 'Invalid email or password.');
        }
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
      
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required',
        ]);
    
        // Create a new  instance
        $user = new user();
        $user->firstname = $request->name;
        $user->lastname = $request->last_name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = $request->role;
         // You should hash passwords for security
    
        if ($user->save()) {
            // Data was inserted successfully
            // Redirect to the index page with a success message
            return redirect()->route('user.index')->with('success', ' created successfully.');
        } else {
            // Data insertion failed
            // Redirect back to the create form with an error message
            return back()->withInput()->with('error', 'Failed to create . Please try again.');
        }
    }

    
   
    
    

    




























    // Show the form for creating a new resource.
    public function create()
    {
        return view('users.create');
    }

   

    // Display the specified resource.
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|max:255|unique:Users,username,' . $id,
            'role' => 'required|in:teacher,student',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
