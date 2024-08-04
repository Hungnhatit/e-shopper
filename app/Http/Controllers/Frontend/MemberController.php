<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\MemberLoginRequest;
use App\Http\Requests\Frontend\MemberRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class MemberController extends Controller
{
    public function index()
    {
        return view('frontend.member.login');
    }

    public function registerIndex() {
        return view('frontend.member.register');
    }

    public function edit()
    {
        if (!Auth::check()) {
            return redirect('/ecommerce');
        }
        $userId = Auth::user()->id;
        $user = User::where('id', $userId)->first()->toArray();
        return view('frontend.member.update', compact('user'));
        // echo ("Hello");
    }

    public function register(MemberRequest $request)
    {
        $file = $request->avatar->getClientOriginalName();
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'avatar' => $file,
            'level' => 0
        ]);
        return redirect('/ecommerce/login');
    }

    public function login(MemberLoginRequest $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => 0
        ];

        $remember = false;
        if ($request->remember_me) {
            $remember = true;
        }

        if (Auth::attempt($login, $remember)) {
            $user = Auth::user();
            Session::put('user', $user);
            return redirect('/ecommerce');
        } else {
            return redirect()->back()->withErrors('Email or password is incorrect');
        }
    }

    public function update(MemberRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->all();
        $avatar = $request->avatar;

        if (!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
        }

        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        } else {
            $data['password'] = $user->password;
        }

        if ($user->update($data)) {
            if (!empty($file)) {
                $avatar->move('upload/user/avatar', $avatar->getClientOriginalName());
            }
            return redirect()->back()->with('success', 'Updated Sucessfully!');
        } else {
            return redirect()->back()->withErrors('An error has occurred. Please check and try again!');
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/ecommerce/login')->with('success', 'Đăng xuất thành công!');
    }
}
