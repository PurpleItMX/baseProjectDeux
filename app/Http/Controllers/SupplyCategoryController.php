<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SupplyCategory;

class SupplyCategoryController extends Controller
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
        $supplyCategories = SupplyCategory::all();
        return view('supply-category.index')->with('supplyCategories',$supplyCategories);
    }

     /**
     * Show the form for create new SupplyCategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supply-category.form')->with('supplyCategory','');
    }

    /**
     * Show the form for edit SupplyCategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        return $supplyCategory = SupplyCategory::findOrFail($id);
    }

    /**
     * Action for save SupplyCategory
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $id = $request['id_supply_category'];
        if($id == NULL){
            $supplyCategory = new SupplyCategory();
	        $supplyCategory->clave = $request['clave'];
	        $supplyCategory->description = $request['description'];
	        $supplyCategory->variant = $request['variant'];
	        $supplyCategory->estatus = ($request['estatus'] == "on")?1:0;
        }else{
            $supplyCategory  = SupplyCategory::findOrFail($id);
            $supplyCategory->clave = $request['clave'];
	        $supplyCategory->description = $request['description'];
	        $supplyCategory->variant = $request['variant'];
	        $supplyCategory->estatus = ($request['estatus'] == "on")?1:0;
        }
            $supplyCategory->save();
        
        if($request['id_supply_category_redirect'] == 'true'){
            return redirect()->action('SupplyCategoryController@index');
        }else{
            return SupplyCategory::all();
        }
    }

    /**
     * Action for delete SupplyCategory
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $supplyCategory = SupplyCategory::findOrFail($id);
        $supplyCategory->delete();
        return redirect()->action('SupplyCategoryController@index');
    }
}
