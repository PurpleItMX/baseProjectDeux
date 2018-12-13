<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use DB;
use App\Quotation;
use App\Menu;

class MenuController extends Controller
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
        $menus = Menu::all();
        $parents = Menu::all()->where("id_parent", NULL);
        return view('menu.index')
        ->with('menus',$menus)
        ->with('parents',$parents);
    }

    public function update($id){
        return Menu::findOrFail($id);
    }



        /**
     * Action for delete Role
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            $menu = Menu::findOrFail($id);
            $menu->delete();
            $menus = Menu::all();
            $parents = Menu::all()->where("id_parent", NULL);
            return view('menu.index')
            ->with('menus',$menus)
            ->with('parents',$parents)
            ->withSuccess('Registro Borrado');
        }catch (QueryException $e){
            DB::rollBack();
            $menus = Menu::all();
            $parents = Menu::all()->where("id_parent", NULL);
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('menu.index')
            ->with('menus',$menus)
            ->with('parents',$parents)
            ->withErrors([$message]);
       }
    }

    public function save(Request $request){
        DB::beginTransaction();
        try {
            $id = $request['id_menu'];
            if($id == NULL){
                $menu = new Menu();
                $message = "Registro Creado";
            }else{
                $menu = Menu::findOrFail($id);
                $message = "Registro Actualizado";    
            }

            $count = Menu::all()->where("id_parent", $request['id_parent'])->count();

            $menu->name = $request['name'];
            $menu->id_parent = $request['id_parent'];
            $menu->icono = $request['icono'];
            $menu->url = ($request['url_menu'] == NULL)?'':$request['url_menu'] ;
            $menu->menu_order = $count;
            $menu->estatus = ($request['estatus'] == "on")?1:0;
            $menu->save();
            DB::commit();
            
            if($request['id_menu_redirect'] == 'true'){
                $menus = Menu::all();
                $parents = Menu::all()->where("id_parent", NULL);
                return view('menu.index')
                ->with('menus',$menus)
                ->with('parents',$parents)
                ->withSuccess($message);
            }else{
                return Menu::all()->where('status',1);
            }
         }catch (QueryException $e){
            DB::rollBack();
            $menus = Menu::all();
            $parents = Menu::all()->where("id_parent", NULL);
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('menu.index')
            ->with('menus',$menus)
            ->with('parents',$parents)
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
            $menu = Menu::where($request['column'], 'like', $request['val'])
            ->where('id_menu', '!=', $request['id'])->get();
        }else{
            $menu = Menu::where($request['column'], 'like', $request['val'])->get();
        }

        return $menu;
    }
}
