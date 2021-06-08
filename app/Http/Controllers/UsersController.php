<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Laravel\Fortify\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('privileges:admin');
    }

    public function listUsers(Request $request)
    {
        if(!empty($request->get('by'))){
            return view('feature.users', [
                'users' => User::latest()
                                    ->where('nik', '=', $request->get('by'))
                                    ->orWhere('name', '=', $request->get('by'))
                                    ->paginate(10)
            ]);    
        }

        return view('feature.users', [
            'users' => User::latest()->paginate(10)
        ]);
    }

    public function updateUsers($id){
        return view("feature.users-update", [
            'id' => $id,
            'user' => User::where('id', '=', $id)->first()
        ]);
    }

    public function handleUpdate(Request $request, $id)
    {
        $rules = array();
        $rules['privileges'] = 'required|string|max:255';
        if (!empty($request->get('password'))) $rules['password'] = 'required|string|min:6|confirmed';

        Validator::make($request->all(), $rules)->validate();

        $data = array();
        $data['privileges'] = $request->get('privileges');
        if (!empty($request->get('password'))) $data['password'] = bcrypt($request->get('password'));
        if (!empty($request->get('uic'))) $data['uic'] = $request->get('uic');

        User::where('id', '=', $id)->update($data);

        return redirect()->route('users');
    }

    public function deleteUsers($id)
    {
        User::where('id', '=', $id)->delete();
        return back();
    }
}
