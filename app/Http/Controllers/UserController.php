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
        ->with('users',$users);
    }

     /**
     * Show the form for create new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.form')
        ->with('user','');
    }

    /**
     * Show the form for edit User.
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        try{
            $user = User::find($id);
            return view('user.form')
            ->with('user',$user);
        }catch (QueryException $e){
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return redirect('/users')->with('error', $message);
       }
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
                $message = "Registro Creado";
            }else{
                $user  = User::findOrFail($id);
                $user->name = $request['name'];
                $user->email = $request['email'];
                $message = "Registro Actualizado";
            }
            $user->save();
            return redirect('/users')->with('success', $message);
       }catch (QueryException $e){
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return redirect('/users')->with('error', $message);
       }
    }

    /**
     * Action for delete User
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try{
            $user = User::find($id);    
            $user->delete();
            return redirect('/users')->with('success', 'Registro Borrado');
        }catch (QueryException $e){
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return redirect('/users')->with('error', $message);
        }
    }

    /**
     * Action for reset password of user
     *
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(Request $request)
    {
        $user  = User::findOrFail($request["id"]);
        $user->password = Hash::make($request["password"]);
        $user->save();
        return  1 ;
    }

    /**
     * Action search if the data exist in the bd.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if($request['id'] != NULL){
            $user = User::where($request['column'], 'like', $request['val'])
            ->where('id_user', '!=', $request['id'])->get();
        }else{
            $user = USer::where($request['column'], 'like', $request['val'])->get();
        }

        return $user;
    }
}
