<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('user.index')->with('users',$users);
    }

     /**
     * Show the form for create new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.form')->with('user','');
    }

    /**
     * Show the form for edit User.
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $user = User::find($id);
        return view('user.form')->with('user',$user);
    }

    /**
     * Action for save User
     *
     * @return \Illuminate\Http\Response
     */
    public function save($id)
    {
        $users = User::all();
        return view('user.index')->with('users',$users);
    }

    /**
     * Action for delete User
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $users = User::all();
        return view('user.index')->with('users',$users);
    }
}
