<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function signup(Request $request){

        $userData = $request->all();
        $validator = Validator::make($userData, [
            'email' => 'required|unique:users|email:rfc,dns,filter',
            'name' => 'required',
            'password' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()){
            return redirect(route('signup-page'))
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User();
        $user->name = $userData['name'];
        $user->email = $userData['email'];
        $user->password = bcrypt($userData['password']);
        $user->contacts = $userData['message'];

        $user->save();

        return redirect(route('main-page'));
    }

    public function login(Request $request){

        $userInfo = $request->only('email', 'password');

        $validator = Validator::make($userInfo, [
            'email' => 'required|email:rfc,dns,filter',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('login-page'))
                ->withErrors($validator)
                ->withInput();
        }

        if(Auth::attempt($userInfo)){
            return redirect('/');
        }

        return redirect(route('login-page'))
            ->withErrors(['auth_error' =>'Email или пароль введены некорректно'])
            ->withInput();
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
