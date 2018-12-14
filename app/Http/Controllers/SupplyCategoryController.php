<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
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
        return view('supply-category.index')
        ->with('supplyCategories',$supplyCategories);
    }

     /**
     * Show the form for create new SupplyCategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){}

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
        try {
            $id = $request['id_supply_category'];
            if($id == NULL){
                $supplyCategory = new SupplyCategory();
    	        $supplyCategory->clave = $request['clave'];
    	        $supplyCategory->description = $request['description'];
    	        $supplyCategory->variant = $request['variant'];
    	        $supplyCategory->estatus = ($request['estatus'] == "on")?1:0;
                $message = "Registro Creado";
            }else{
                $supplyCategory  = SupplyCategory::findOrFail($id);
                $supplyCategory->clave = $request['clave'];
    	        $supplyCategory->description = $request['description'];
    	        $supplyCategory->variant = $request['variant'];
    	        $supplyCategory->estatus = ($request['estatus'] == "on")?1:0;
                $message = "Registro Actualizado";
            }
                $supplyCategory->save();
            
            if($request['id_supply_category_redirect'] == 'true'){
                return redirect('/supply-categories')->with('success', $message);
            }else{
                return SupplyCategory::all()->where('estatus',1);
            }
        }catch (QueryException $e){
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return redirect('/supply-categories')->with('error', $message);
       }
    }

    /**
     * Action for delete SupplyCategory
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            $supplyCategory = SupplyCategory::findOrFail($id);
            $supplyCategory->delete();
            return redirect('/supply-categories')->with('success', 'Registro Borrado');
        }catch (QueryException $e){
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return redirect('/supply-categories')->with('error', $message);
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
            $supplyCategory = SupplyCategory::where($request['column'], 'like', $request['val'])
            ->where('id_supply_category', '!=', $request['id'])->get();
        }else{
            $supplyCategory = SupplyCategory::where($request['column'], 'like', $request['val'])->get();
        }

        return $supplyCategory;
    }
}
