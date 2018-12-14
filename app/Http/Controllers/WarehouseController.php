<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Warehouse;

class WarehouseController extends Controller
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
        $warehouses = Warehouse::all();
        return view('warehouse.index')
        ->with('warehouses',$warehouses);
    }

     /**
     * Show the form for create new Warehouse.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){}

    /**
     * Show the form for edit Warehouse.
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        try{
            $warehouse = Warehouse::findOrFail($id);
            return $warehouse;
        }catch (QueryException $e){
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return redirect('/warehouses')->with('success', $message);
       }
    }

    /**
     * Action for save Warehouse
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        try{
            $id = $request['id_warehouse'];
            if($id == NULL){
                $warehouse = new Warehouse();
    	        $warehouse->clave = $request['clave'];
    	        $warehouse->description = $request['description'];
    	        $warehouse->prorate = ($request['prorate'] == "on")?1:0;
    	        $warehouse->estatus = ($request['estatus'] == "on")?1:0;
                $message = "Registro Creado";
            }else{
                $warehouse  = Warehouse::findOrFail($id);
                $warehouse->clave = $request['clave'];
    	        $warehouse->description = $request['description'];
    	        $warehouse->prorate = ($request['prorate'] == "on")?1:0;
    	        $warehouse->estatus = ($request['estatus'] == "on")?1:0;
                $message = "Registro Actualizado";
            }
            $warehouse->save();
            if($request['id_warehouse_redirect'] == 'true'){
                return redirect('/warehouses')->with('success', $message);
            }else{
                return Warehouse::all()->where('estatus',1);
            }
        }catch (QueryException $e){
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return redirect('/warehouses')->with('error', $message);
       }
    }

    /**
     * Action for delete Warehouse
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try{
            $warehouse = Warehouse::findOrFail($id);
    	    $warehouse->delete();
            return redirect('/warehouses')->with('success', 'Registro Borrado');
        }catch (QueryException $e){
           $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return redirect('/warehouses')->with('error', $message);
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
            $warehouse = Warehouse::where($request['column'], 'like', $request['val'])
            ->where('id_warehouse', '!=', $request['id'])->get();
        }else{
            $warehouse = Warehouse::where($request['column'], 'like', $request['val'])->get();
        }

        return $warehouse;
    }
}
