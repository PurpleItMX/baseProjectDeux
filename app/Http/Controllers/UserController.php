<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
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
        return view('user.index')
        ->with('users',$users)
        ->with('error', '');
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
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        try {
            $id = $request['id_user'];
            if($id == NULL){
                $user = new User();
                $user->name = $request['name'];
                $user->email = $request['email'];
                $user->password = Hash::make($request['password']);
                $user->remember_token = str_random(10);
            }else{
                $user  = User::findOrFail($id);
                $user->name = $request['name'];
                $user->email = $request['email'];
            }
                $user->save();
           return redirect()->action('UserController@index');
       }catch (QueryException $e){
            $error = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return redirect()->action('UserController@index')
            ->with('error', $error);
       }
    }

    /**
     * Action for delete User
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $user = User::find($id);    
        $user->delete();
        return redirect()->action('UserController@index');
    }

    /**
     * Action for reset password of user
     *
     * @return \Illuminate\Http\Response
     */
    public function resetPassword($id)
    {
        $user  = User::findOrFail($id);
        $user->password = Hash::make('12345678');
        $user->save();
        return redirect()->action('UserController@index');
    }
}
