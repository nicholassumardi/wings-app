<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->has('_token')) {
            if (Auth::attempt([
                'email'    => $request->email,
                'password' => $request->password,
            ])) {
                $user = Auth::user();
                foreach ($user->userRole as $ur) {
                    $role[] = $ur->role_id;
                }
                session([
                    'user_id'     => $user->id,
                    'user_name'   => $user->name,
                    'user_email'  => $user->email,
                    'user_role'   => $role
                ]);


                return redirect('admin');
            } else {
                return redirect()->back()->with(['failed' => 'Account not found']);
            }
        } else {
            $data = [
                'title'   => 'Login User',
                'content' => 'auth.login',
            ];

            return view('auth.layouts.index', ['data' => $data]);
        }
    }


    public function logout()
    {
        Auth::logout();

        return redirect('/')->with(['success' => 'You have successfully logout.']);
    }


    public function register(Request $request)
    {
        if ($request->has('_token')) {
            $validation = Validator::make(
                $request->all(),
                [
                    'email'          => 'required|email|unique:users,email',
                    'name'           => 'required',
                    'password'       => 'required',
                    'password_again' => 'required',
                ],
                [
                    'email.required'          => 'Email cannot be empty.',
                    'email.unique'            => 'The email address has already been taken.',
                    'name.required'           => 'name cannot empty.',
                    'password.required'       => 'password cannot empty.',
                    'password_again.required' => 'password cannot empty.',

                ]
            );
            if ($validation->fails()) {
                return redirect()->back()->withErrors($validation)->withInput();
            } else if ($request->password != $request->password_again) {
                return redirect()->back()->with(['failed' => 'password not match']);
            } else {
                $user =  User::create([
                    'email'  => $request->email,
                    'name'  => $request->name,
                    'password'  => Hash::make($request->password),
                ]);

                UserRole::create([
                    'user_id' => $user->id,
                    'role_id' => 2,
                ]);

                return redirect('/')->with(['success' => 'Account successfully regitered']);
            }
        } else {
            if (Auth::check()) {
                return redirect()->back();
            } else {

                $data = [
                    'title'   => 'Register User',
                    'content' => 'auth.register',
                ];

                return view('auth.layouts.index', ['data' => $data]);
            }
        }
    }
}
