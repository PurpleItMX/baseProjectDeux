<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return view('warehouse.index')->with('warehouses',$warehouses);
    }

     /**
     * Show the form for create new Warehouse.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('warehouse.form')->with('warehouse','');
    }

    /**
     * Show the form for edit Warehouse.
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        return view('warehouse.form')->with('warehouse',$warehouse);
    }

    /**
     * Action for save Warehouse
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $id = $request['id_warehouse'];
        if($id == NULL){
            $warehouse = new Warehouse();
	        $warehouse->clave = $request['clave'];
	        $warehouse->description = $request['description'];
	        $warehouse->prorate = ($request['prorate'] == "on")?1:0;
	        $warehouse->estatus = ($request['estatus'] == "on")?1:0;
        }else{
            $warehouse  = Warehouse::findOrFail($id);
            $warehouse->clave = $request['clave'];
	        $warehouse->description = $request['description'];
	        $warehouse->prorate = ($request['prorate'] == "on")?1:0;
	        $warehouse->estatus = ($request['estatus'] == "on")?1:0;
        }
            $warehouse->save();
        return redirect()->action('WarehouseController@index');
    }

    /**
     * Action for delete Warehouse
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
    	Warehouse::deleteById($id);
        return redirect()->action('WarehouseController@index');
    }
}
