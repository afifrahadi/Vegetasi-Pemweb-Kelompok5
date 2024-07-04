<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // Login page for customer
    public function index(){
        return view('login');
    }

    // Authenticate user
    public function authenticate(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if($validator->passes()){
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                // dd('Redirecting to Pegawai.index');
                return redirect()->route('dashboard.wilayah.index');
            }else{
                return redirect()->route('account.login')->with('error', 'Either email or password is incorrect.');
            }
        }else{
            return redirect()->route('account.login')->withInput()->withErrors($validator);
        }
    }
    //Show register page
    public function register(Request $request){
        return view('register');
    }

    // Register new account
    public function processRegister(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);
        if($validator->passes()){
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            // $user->role = 'customer';
            $user->save();

            return redirect()->route('account.login')->with('success', 'You have registered successfully');
        }else{
            return redirect()->route('account.register')->withInput()->withErrors($validator);
        }
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('main');
    }
}
