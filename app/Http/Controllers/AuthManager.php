<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Container\Attributes\Auth as AttributesAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Symfony\Contracts\Service\Attribute\Required;

class AuthManager extends Controller
{
    public function postRoute(Request $request){
        $action = $request->input('action');

        if($action = 'login'){
            return $this->loginPost($request);
        }elseif($action = 'register'){
            return $this->registerPost($request);
        }else{
            return back()->with('errors', 'action not valid');
        }
    }

    public function loginPost(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Successful login
            Auth::login($user);
            if($user->usertype == 'admin'){
                return redirect()->intended(route('admin.dashboard'))->with('success', 'login success');
            }
            return redirect()->back()->with('success', 'Login successful');
        } else {
            // Failed login, redirect back with error message and keep the form data
            return redirect()->back()
                ->with('error', 'Invalid credentials')
                ->withInput(); // This will retain the user's input (email)
        }

    //    $credentials = $request->only('email', 'password');
    //    if(FacadesAuth::attempt($credentials)){
    //        return redirect()->back()->with('success', 'Login success');
    //    }
    //    return redirect()->back()->with('errors', 'login details are not valid');
    }

    public function registerPost(Request $request){
        $request->validate([
            'username'=>'required|min:4',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed',
            'phone'=>'required|numeric',
        ]);

        $data['name'] = $request->username;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['phone'] = $request->phone;
        $user = User::create($data);

        if(!$user){
            return redirect()->back()->with('errors', 'Register Failed');
        }
        
        Auth::login($user);
        if($user->usertype == 'admin'){
            return redirect()->intended(route('admin.dashboard'))->with('success', 'login success');
        }
        return redirect()->back()->with('success', 'Login successful');
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('main'));
    }

    public function updateProfile(Request $request)
    {
        // Get the currently authenticated user
        $user = Auth::user();

// Validate the input]
$request->validate([
    'email' => 'required|email|max:255|unique:users,email,' . $user->id,
    'phone' => 'required|string|max:15',
    'address' => 'required|string|max:255',
    'current_password' => 'required',
    'new_password' => 'nullable|min:8|confirmed',
]);

// Check if the current password is correct
if (!Hash::check($request->current_password, $user->password)) {
    return back()->withErrors(['current_password' => 'The current password is incorrect.']);
}

// Prepare data to be updated
$updateData = [
    'email' => $request->email,
    'phone' => $request->phone,
    'address' => $request->address,
];

// Update password if a new password is provided
if ($request->new_password) {
    $updateData['password'] = Hash::make($request->new_password);
}

// Update the user using the update() method
$user->update($updateData);

// Redirect back with a success message
return back()->with('success', 'Profile updated successfully.');


}
}


