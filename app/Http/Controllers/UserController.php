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

    public function profil()
    {
        $userId = Session::get('user_id');
        $user = user::where('user_id', $userId)->firstOrFail();
        return view('users.profil', compact('user'));
    }
      public function edit()
    {
        $userId = Session::get('user_id');
        $user = user::where('user_id', $userId)->firstOrFail(); // Find the user by ID
        return view('users.edit', compact('user')); // Pass user data to the edit view
    }

    public function update(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' ,
           
        ]);
        $userId = Session::get('user_id');
        DB::table('userss') // Change 'users' to your actual table name if different
        ->where('user_id', $userId) // Using user_id for the where clause
        ->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            
        ]);

        return redirect()->route('user.profil')->with('success', 'Profile updated successfully!');
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
            } elseif ($user->role == 'admin') {
                session([
                    'user_id' => $user->user_id,
                    'user_name' => $user->firstname,
                    'user_lastname' => $user->lastname,
                ]);
                return redirect()->route('product.indexadmin'); // Redirect to student dashboard
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

    public function disconnect()
{
    // Clear specific session variables
    Session::forget(['user_id', 'user_name', 'user_lastname']);

    // Alternatively, you can destroy the entire session
    // Session::flush();

    // Redirect to the desired route (e.g., login page)
    return redirect()->route('user.index')->with('success', 'Vous êtes déconnecté avec succès.');
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
 

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
