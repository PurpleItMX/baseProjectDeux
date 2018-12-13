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
        try{
            $supplyTypes = SupplyType::all();
            $supplyCategoriesAll = SupplyCategory::all();
            $supplyCategories = SupplyCategory::all()->where('estatus',1);
            return view('supply-type.index')
            ->with('supplyTypes',$supplyTypes)
            ->with('supplyCategories',$supplyCategories)
            ->with('supplyCategoriesAll',$supplyCategoriesAll);
        }catch (QueryException $e){
            $supplyTypes = SupplyType::all();
            $supplyCategoriesAll = SupplyCategory::all();
            $supplyCategories = SupplyCategory::all()->where('estatus',1);
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('supply-type.index')
            ->with('supplyTypes',$supplyTypes)
            ->with('supplyCategories',$supplyCategories)
            ->with('supplyCategoriesAll',$supplyCategoriesAll)
            ->withErrors([$message]);
       }
    }

     /**
     * Show the form for create new SupplyType.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){}

    /**
     * Show the form for edit SupplyType.
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        return $supplyType = SupplyType::findOrFail($id);
    }

    /**
     * Action for save SupplyType
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        try{
            $id = $request['id_supply_type'];
            if($id == NULL){
                $supplyType = new SupplyType();
    	        $supplyType->clave = $request['clave'];
    	        $supplyType->description = $request['description'];
    	        $supplyType->id_supply_category = $request['id_supply_category'];
    	        $supplyType->estatus = ($request['estatus'] == "on")?1:0;
                $message = "Registro Creado";
            }else{
                $supplyType = SupplyType::findOrFail($id);
                $supplyType->clave = $request['clave'];
                $supplyType->description = $request['description'];
                $supplyType->id_supply_category = $request['id_supply_category'];
                $supplyType->estatus = ($request['estatus'] == "on")?1:0;   
                $message = "Registro Actualizado";    
            }
                $supplyType->save();
            if($request['id_supply_type_redirect'] == 'true'){
                $supplyCategoriesAll = SupplyCategory::all();
                $supplyTypes = SupplyType::all();
                $supplyCategories = SupplyCategory::all()->where('estatus',1);
                return view('supply-type.index')
                ->with('supplyTypes',$supplyTypes)
                ->with('supplyCategories',$supplyCategories)
                ->with('supplyCategoriesAll',$supplyCategoriesAll)
                ->withSuccess($message);
             }else{
                return SupplyType::all()->where('estatus',1);
            }
        }catch (QueryException $e){
            $supplyCategoriesAll = SupplyCategory::all();
            $supplyTypes = SupplyType::all();
            $supplyCategories = SupplyCategory::all()->where('estatus',1);
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('supply-type.index')
            ->with('supplyTypes',$supplyTypes)
            ->with('supplyCategories',$supplyCategories)
            ->with('supplyCategoriesAll',$supplyCategoriesAll)
            ->withErrors([$message]);
       }
    }

    /**
     * Action for delete SupplyType
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try{
            $supplyType = SupplyType::findOrFail($id);
            $supplyType->delete();
            $supplyTypes = SupplyType::all();
            $supplyCategoriesAll = SupplyCategory::all();
            $supplyCategories = SupplyCategory::all()->where('estatus',1);
            return view('supply-type.index')
            ->with('supplyTypes',$supplyTypes)
            ->with('supplyCategories',$supplyCategories)
            ->with('supplyCategoriesAll',$supplyCategoriesAll)
            ->withSuccess('Registro Borrado');
        }catch (QueryException $e){
            $supplyTypes = SupplyType::all();
            $supplyCategoriesAll = SupplyCategory::all();
            $supplyCategories = SupplyCategory::all()->where('estatus',1);
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('supply-type.index')
            ->with('supplyTypes',$supplyTypes)
            ->with('supplyCategories',$supplyCategories)
            ->with('supplyCategoriesAll',$supplyCategoriesAll)
            ->withErrors([$message]);
       }
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

    /**
     * Action search if the data exist in the bd.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if($request['id'] != NULL){
            $supplyType = SupplyType::where($request['column'], 'like', $request['val'])
            ->where('id_supply_type', '!=', $request['id'])->get();
        }else{
            $supplyType = SupplyType::where($request['column'], 'like', $request['val'])->get();
        }

        return $supplyType;
    }
}