<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use DB;
use App\Quotation;
use App\Role;
use App\Menu;

class RoleController extends Controller
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
        $roles = Role::all();
        return view('role.index')
        ->with('roles',$roles);
    }


    public function update($id){
        return Role::findOrFail($id);
    }

    public function save(Request $request){
        DB::beginTransaction();
        try {
            $id = $request['id_role'];
            if($id == NULL){
                $role = new Role();
                $message = "Registro Creado";
            }else{
                $role = Role::findOrFail($id);
                $message = "Registro Actualizado";    
            }
            $role->name = $request['name'];
            $role->status = ($request['estatus'] == "on")?1:0;
            $role->save();
            DB::commit();
            
            if($request['id_role_redirect'] == 'true'){
                $roles = Role::all();
                return view('role.index')
                ->with('roles',$roles)
                ->withSuccess($message);
            }else{
                return Role::all()->where('status',1);
            }
         }catch (QueryException $e){
            DB::rollBack();
            $roles = Role::all();
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('role.index')
                ->with('roles',$roles)
            ->withErrors([$message]);
       }

    }

    /**
     * Action for delete Role
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->delete();
            $roles = Role::all();
            return view('role.index')
            ->with('roles',$roles)
            ->withSuccess('Registro Borrado');
        }catch (QueryException $e){
            $roles = Role::all();
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('role.index.index')
            ->with('roles',$roles)
            ->withErrors([$message]);
       }
    }

    /**
     * Action search if the data exist in the bd.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if($request['id'] != NULL){
            $role = Role::where($request['column'], 'like', $request['val'])
            ->where('id_role', '!=', $request['id'])->get();
        }else{
            $role = Role::where($request['column'], 'like', $request['val'])->get();
        }

        return $role;
    }
}
