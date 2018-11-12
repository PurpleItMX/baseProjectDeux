<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\SupplyType;
use App\SupplyCategory;

class SupplyTypeController extends Controller
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
        $supplyTypes = SupplyType::all();
        $supplyCategories = SupplyCategory::all();
        return view('supply-type.index')
        ->with('supplyTypes',$supplyTypes)
        ->with('supplyCategories',$supplyCategories);
    }

     /**
     * Show the form for create new SupplyType.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplyCategories = SupplyCategory::all();
        return view('supply-type.form')
        ->with('supplyType','')
        ->with('supplyCategories',$supplyCategories);
    }

    /**
     * Show the form for edit SupplyType.
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        return $supplyType = SupplyType::findOrFail($id);
        /*return view('supply-type.form')
        ->with('supplyType',$supplyType)
        ->with('supplyCategories',$supplyCategories);*/
    }

    /**
     * Action for save SupplyType
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $id = $request['id_supply_type'];
        if($id == NULL){
            $supplyType = new SupplyType();
	        $supplyType->clave = $request['clave'];
	        $supplyType->description = $request['description'];
	        $supplyType->id_supply_category = $request['id_supply_category'];
	        $supplyType->estatus = ($request['estatus'] == "on")?1:0;
        }else{
            $supplyType = SupplyType::findOrFail($id);
            $supplyType->clave = $request['clave'];
            $supplyType->description = $request['description'];
            $supplyType->id_supply_category = $request['id_supply_category'];
            $supplyType->estatus = ($request['estatus'] == "on")?1:0;       
        }
            $supplyType->save();
        if($request['id_supply_type_redirect'] == 'true'){
            return redirect()->action('SupplyTypeController@index');
         }else{
            return SupplyType::all();
        }
    }

    /**
     * Action for delete SupplyType
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
    	SupplyType::deleteById($id);
        return redirect()->action('SupplyTypeController@index');
    }

     /**
     * Action for SupplyType by category
     *
     * @return \Illuminate\Http\Response
     */
    public function category($id)
    {
        $supplyTypes = SupplyType::all()->where('estatus', 1)->where('id_supply_category', $id);
        return $supplyTypes;
    }
}