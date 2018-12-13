<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supply;
use App\Subrecipe;
use App\SubrecipeSupply;

class SubrecipeController extends Controller
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
            $subrecipes = Subrecipe::all();
            return view('subrecipe.index')
            ->with('subrecipes',$subrecipes);
        }catch (QueryException $e){
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('subrecipe.index')
            ->withErrors([$message]);
        }
    }

     /**
     * Show the form for create new Supply.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){}

    /**
     * Show the form for edit Supply.
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $return = Array();
        $return["subrecipe"] = Subrecipe::findOrFail($id);
        $return["subrecipeSupply"] = SubrecipeSupply::all()->where('id_subrecipe', $id);
        return $return;
    }

    /**
     * Action for save Supply
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        try {
            $id = $request['id_subrecipe'];
            if($id == NULL){
                $subrecipe = new Subrecipe();
                $subrecipe->clave = $request['clave'];
                $subrecipe->udm = $request['umd'];
                $subrecipe->description = $request['description'];
				$subrecipe->unit_cost = $request['unit_cost'];
				$subrecipe->performance = $request['performance'];
				$subrecipe->recipe_cost = $request['recipe_cost'];
				$subrecipe->previous_production_week = $request['previous_production_week'];
				$subrecipe->quantity_produce = $request['quantity_produce'];
                $subrecipe->estatus = ($request['estatus'] == "on")?1:0;
                $message = "Registro Creado";
            }else{
                $subrecipe  = Subrecipe::findOrFail($id);
               	$subrecipe->clave = $request['clave'];
                $subrecipe->udm = $request['umd'];
                $subrecipe->description = $request['description'];
				$subrecipe->unit_cost = $request['unit_cost'];
				$subrecipe->performance = $request['performance'];
				$subrecipe->recipe_cost = $request['recipe_cost'];
				$subrecipe->previous_production_week = $request['previous_production_week'];
				$subrecipe->quantity_produce = $request['quantity_produce'];
                $subrecipe->estatus = ($request['estatus'] == "on")?1:0;
                $subrecipeSupplies = SubrecipeSupply::all()->where('id_subrecipe', $id);
                
                foreach($subrecipeSupplies as $subrecipeSupplyTable){
                    $subrecipeSupply = SubrecipeSupply::findOrFail($subrecipeSupplyTable->id_subrecipe_supply);
                    $subrecipeSupply->delete();
                }
                $message = "Registro Actualizado";
            }
            $subrecipe->save();

            foreach(json_decode($request['supplies_subrecipe'], true) as $supply){
                if($supply != NULL){
                    $subrecipeSupply = new SubrecipeSupply();
                    $subrecipeSupply->id_subrecipe = $subrecipe->id_subrecipe;
                    $subrecipeSupply->id_supply = $supply["id_supply"];
                    $subrecipeSupply->clave = $supply["clave"];
                    $subrecipeSupply->description = $supply["description"];
                    $subrecipeSupply->unity = $supply["unity"];
                    $subrecipeSupply->cost = $supply["cost"];
                    $subrecipeSupply->gr_recipe = $supply["gr_recipe"];
                    $subrecipeSupply->performance = $supply["performance"];
                    $subrecipeSupply->gr_neto = $supply["gr_neto"];
                    $subrecipeSupply->cost_supply = $supply["cost_supply"];
                    $subrecipeSupply->quantity_occupy = $supply["quantity_occupy"];
                    $subrecipeSupply->production_required = $supply["production_required"];
                    $subrecipeSupply->save();
                }
            }
            
            if($request['id_subrecipe_redirect'] == 'true'){
            	$subrecipes = Subrecipe::all();
            	return view('subrecipe.index')
            	->with('subrecipes',$subrecipes)
                ->withSuccess($message);
            }else{
                return Subrecipe::all();
            }
        }catch (QueryException $e){
            $subrecipes = Subrecipe::all();
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('subrecipe.index')
            ->with('subrecipes',$subrecipes)
            ->withErrors([$message]);
       }
    }

    /**
     * Action for delete Supply
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            $subrecipe = Subrecipe::findOrFail($id);
            $subrecipe->delete();
            $subrecipes = Subrecipe::all();
            return view('subrecipe.index')
            ->with('subrecipes',$subrecipes)
            ->withSuccess('Registro Borrado');
        }catch (QueryException $e){
            $subrecipes = Subrecipe::all();
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('subrecipe.index')
            ->with('subrecipes',$subrecipes)
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
            $subrecipe = Subrecipe::where($request['column'], 'like', $request['val'])
            ->where('id_subrecipe', '!=', $request['id'])->get();
        }else{
            $subrecipe = Subrecipe::where($request['column'], 'like', $request['val'])->get();
        }

        return $subrecipe;
    }

    /**
     * Action search the supply for add the subrecipe
     *
     * @return \Illuminate\Http\Response
     */

    public function supply(Request $request){
    	$supply = Supply::where($request['column'], 'like', $request['val'])
    	->where('estatus', 1)
    	->where('id_supply', '!=' ,$request['id_supply'])
    	->first();
    	return $supply;
    }


     /**
     * Show the form for fing supply.
     *
     * @return \Illuminate\Http\Response
     */
    public function findClave($clave)
    {
    	$supply = Supply::where('clave', 'like', $clave)
    	->where('estatus', 1)
    	->where('is_product',1)
    	->first();
        return $supply;
    }
}

