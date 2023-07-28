<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function login()
    {
        return view('login');
    }
    public function login_action(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'email.required' => 'Email harus diisi',
                'password.required' => 'Password harus diisi',
            ]
        );
        if ($validator->fails()) {
            return redirect('/')->withErrors($validator);
        } else {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                if (Auth::user()->role == 0) {
                    return redirect()->intended('/dashboard_admin');
                } else {
                    return redirect()->intended('/dashboard');
                }
            } else {
                return redirect('/')->with('failed', 'email atau password salah');
            }
        }
    }
    public function register()
    {
        return view('register');
    }
    public function register_action(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "name" => "required",
                'email' => "required|unique:App\Models\User,email",
                "password" => 'required',
                'password1' => 'required|same:password'
            ],
            [

                "name.required" => "Nama harus diisi",
                'email.required' => "Email harus diisi",
                'email.unique' => "Email sudah terdaftar!",
                "password.required" => 'password harus diisi',
                'password1.required' => 'password harus diisi',
                'password1.same' => 'password tidak sama',
            ]
        );
        if ($validator->fails()) {
            return redirect('register')->withErrors($validator)->with('failed', 'terjadi kesalahan');
        } else {
            $password = $request->password;
            $password1 = $request->password1;
            if ($password != $password1) {
                return redirect('register')->withErrors($validator)->with('failed', 'terjadi kesalahan');
            }
            DB::table('users')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($password),
                'role' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            return redirect('/')->with('success', 'berhasil ')->with('success', 'Berhasil membuat akun, Silahkan login!');
        }
    }
    public function logout_action(Request $request)
    {
        Auth::logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        if (Auth::check()) {
            return redirect('/dashboard')->with('failed', 'terjadi kesalahan');
        } else {
            return redirect('/')->with('success', 'Anda berhasil Logout');
        }
    }
}
