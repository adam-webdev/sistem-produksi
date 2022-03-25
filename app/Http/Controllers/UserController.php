<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('user.index', ['user'  => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pass = $request->get('passw');
        $kpass = $request->get('kpassw');
        if ($pass == $kpass) {
            $save_user = new User;
            $save_user->name = $request->get('name');
            $save_user->email = $request->get('email');
            $save_user->password = \Hash::make($request->get('passw'));
            $save_user->alamat = $request->get('alamat');
            $save_user->telephone = $request->get('tlp');
            $save_user->save();
        }
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
        return view('user.edit', ['user'  => $user_edit]);
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
        $pass = $request->get('passw');
        $kpass = $request->get('kpassw');
        $user = User::findOrFail($id);
        if ($request->get('ubahpass') == 'ubah') {
            if ($pass == $kpass) {
                $user->name = $request->get('name');
                $user->email = $request->get('email');
                $user->alamat = $request->get('alamat');
                $user->telephone = $request->get('tlp');
                $user->password = \Hash::make($request->get('passw'));
                $user->save();
            }
        } else {
            $user->email = $request->get('email');
            $user->name = $request->get('name');
            $user->alamat = $request->get('alamat');
            $user->telephone = $request->get('tlp');
            $user->save();
        }
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index');
    }
}