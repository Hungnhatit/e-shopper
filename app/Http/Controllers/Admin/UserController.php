<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileRequest;
use App\Http\Requests\Admin\UpdateProfileRequest;
use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class UserController extends Controller
{
    public function index($id)
    {
        $user = User::where('id', $id)->get()->toArray();
        $countries = Country::all()->toArray();
        return view('admin.dashboards.page_profile', compact('user', 'countries'));
    }

    public function store(ProfileRequest $request)
    {
        echo 'hello';
    }
    public function update(ProfileRequest $request, $id)
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);

        $data = $request->all();
        $file = $request->avatar;

        if (!empty($file)) {
            $data['avatar']= $file->getClientOriginalName();
        }

        if($data['password']) {
            $data['password'] = bcrypt($data['password']);
        } else {
            $data['password'] = $user->password;
        }

        if ($user->update($data)) {
            if (!empty($file)) {
                $file->move('upload/user/avatar', $file->getClientOriginalName());
            }
            return redirect()->back()->with('success', __('Updated profile successfully!'));
        } else {
            return redirect()->back()->withErrors('An error has occurred. Please check and try again!');
        }

        // dd($request->avatar);
    }
    public function formBasic()
    {
        return view('admin.dashboards.form_basic');
    }
}
