<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supply;
use App\Recipe;
use App\RecipeSupply;

class RecipeController extends Controller
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
             $recipes = Recipe::all();
            return view('recipe.index')
            ->with('recipes',$recipes);
        }catch (QueryException $e){
            $recipes = Recipe::all();
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('recipe.index')
            ->with('recipes',$recipes)
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
        $return["recipe"] = Recipe::findOrFail($id);
        $return["recipeSupply"] = RecipeSupply::all()->where('id_recipe', $id);
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
            $id = $request['id_recipe'];
            if($id == NULL){
                $recipe = new Recipe();
                $recipe->clave = $request['clave'];
                $recipe->udm = $request['umd'];
                $recipe->description = $request['description'];
                $recipe->cost_sale = $request['cost_sale'];
                $recipe->expenditure_operative = $request['expenditure_operative'];
                $recipe->margen_actually = $request['margen_actually'];
                $recipe->margen_category = $request['margen_category']; 
                $recipe->price_sale = $request['price_sale'];
                $recipe->utility = $request['utility'];
                $recipe->iva = $request['iva'];
                $recipe->import_iva = $request['import_iva'];
                $recipe->price_sale_iva = $request['price_sale_iva'];
                $recipe->quantity_sale = $request['quantity_sale'];
                $recipe->production_cost = $request['production_cost'];
                $recipe->quantity_sell = $request['quantity_sell'];
                $recipe->cost_projection = $request['cost_projection'];
                $recipe->estatus = ($request['estatus'] == "on")?1:0;
                $message = "Registro Creado";
            }else{
                $recipe  = Recipe::findOrFail($id);
                $recipe->clave = $request['clave'];
                $recipe->udm = $request['umd'];
                $recipe->description = $request['description'];
                $recipe->cost_sale = $request['cost_sale'];
                $recipe->expenditure_operative = $request['expenditure_operative'];
                $recipe->margen_actually = $request['margen_actually'];
                $recipe->margen_category = $request['margen_category']; 
                $recipe->price_sale = $request['price_sale'];
                $recipe->utility = $request['utility'];
                $recipe->iva = $request['iva'];
                $recipe->import_iva = $request['import_iva'];
                $recipe->price_sale_iva = $request['price_sale_iva'];
                $recipe->quantity_sale = $request['quantity_sale'];
                $recipe->production_cost = $request['production_cost'];
                $recipe->quantity_sell = $request['quantity_sell'];
                $recipe->cost_projection = $request['cost_projection'];
                $recipe->estatus = ($request['estatus'] == "on")?1:0;
                $recipeSupplies = RecipeSupply::all()->where('id_recipe', $id);
                
                foreach($recipeSupplies as $recipeSupplyTable){
                    $recipeSupply = RecipeSupply::findOrFail($recipeSupplyTable->id_recipe_supply);
                    $recipeSupply->delete();
                }
                $message = "Registro Actualizado";
            }
            $recipe->save();

            foreach(json_decode($request['supplies_recipe'], true) as $supply){
                if($supply != NULL){
                    $recipeSupply = new RecipeSupply();
                    $recipeSupply->id_recipe = $recipe->id_recipe;
                    $recipeSupply->id_supply = $supply["id_supply"];
                    $recipeSupply->clave = $supply["clave"];
                    $recipeSupply->description = $supply["description"];
                    $recipeSupply->unity = $supply["unity"];
                    $recipeSupply->cost = $supply["cost"];
                    $recipeSupply->gr_recipe = $supply["gr_recipe"];
                    $recipeSupply->performance = $supply["performance"];
                    $recipeSupply->gr_neto = $supply["gr_neto"];
                    $recipeSupply->cost_supply = $supply["cost_supply"];
                    $recipeSupply->quantity_occupy = $supply["quantity_occupy"];
                    $recipeSupply->cost_total = $supply["cost_total"];
                    $recipeSupply->save();
                }
            }
            
            if($request['id_recipe_redirect'] == 'true'){
                $recipes = Recipe::all();
                return view('recipe.index')
                ->with('recipes',$recipes)
                ->withSuccess($message);
            }else{
                return Recipe::all();
            }
        }catch (QueryException $e){
            $recipes = Recipe::all();
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('recipe.index')
            ->with('recipes',$recipes)
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
            $recipe = Recipe::findOrFail($id);
            $recipe->delete();
            $recipes = Recipe::all();
            return view('recipe.index')
            ->with('recipes',$recipes)
            ->withSuccess('Registro Borrado');
        }catch (QueryException $e){
            $recipes = Recipe::all();
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('recipe.index')
            ->with('recipes',$recipes)
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
            $recipe = Recipe::where($request['column'], 'like', $request['val'])
            ->where('id_recipe', '!=', $request['id'])->get();
        }else{
            $recipe = Recipe::where($request['column'], 'like', $request['val'])->get();
        }

        return $recipe;
    }

    /**
     * Action search the supply for add the subrecipe
     *
     * @return \Illuminate\Http\Response
     */

    public function supply(Request $request){
        $supply = Supply::where($request['column'], 'like', $request['val'])
        ->where('estatus', 1)
        ->where('is_product',1)
        ->first();
        return $supply;
    }

}

