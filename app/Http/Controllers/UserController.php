<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.users.index', ['users'  => $users]);
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
        // $pass = $request->password;
        // $cpass = $request->cpassword;

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('user.index')
                ->withErrors($validator)
                ->withInput();
        }
        $save_user = new User;
        $save_user->name = $request->name;
        $save_user->email = $request->email;
        $save_user->password = \Hash::make($request->password);
        $save_user->save();
        $save_user->assignRole($request->roles);
        Alert::success('Berhasil', 'User Berhasil Ditambahkan');
        return redirect()->route('user.index');
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
        $user_edit = User::findOrFail($id);
        return view('admin.users.edit', ['user'  => $user_edit]);
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
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('user.index')
                ->withErrors($validator)
                ->withInput();
        }
        $save_user =  User::findOrFail($id);
        $save_user->name = $request->name;
        $save_user->email = $request->email;
        $save_user->password = \Hash::make($request->password);
        $save_user->save();
        $save_user->assignRole($request->roles);
        Alert::success('Berhasil', 'User Berhasil Ditambahkan');
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        Alert::success('Berhasil', 'User Berhasil Dihapus');
        return redirect()->route('user.index');
    }
}