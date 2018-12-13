<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\ProviderType;
use App\ProviderCategory;

class ProviderTypeController extends Controller
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
            $providerTypes = ProviderType::all();
            $providerCategories = ProviderCategory::all()->where('estatus',1);
            $providerCategoriesAll = ProviderCategory::all();
            return view('provider-type.index')
            ->with('providerTypes',$providerTypes)
            ->with('providerCategoriesAll',$providerCategoriesAll)
            ->with('providerCategories',$providerCategories);
        }catch (QueryException $e){
            $providerTypes = ProviderType::all();
            $providerCategories = ProviderCategory::all()->where('estatus',1);
            $providerCategoriesAll = ProviderCategory::all();
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('provider-type.index')
            ->with('providerTypes',$providerTypes)
            ->with('providerCategoriesAll',$providerCategoriesAll)
            ->with('providerCategories',$providerCategories)
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
        return $providerType = ProviderType::findOrFail($id);
    }

    /**
     * Action for save ProviderType
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        try{
            $id = $request['id_provider_type'];
            if($id == NULL){
                $providerType = new ProviderType();
    	        $providerType->clave = $request['clave'];
    	        $providerType->description = $request['description'];
    	        $providerType->id_provider_category = $request['id_provider_category'];
    	        $providerType->estatus = ($request['estatus'] == "on")?1:0;
                $message = "Registro Creado";
            }else{
                $providerType = ProviderType::findOrFail($id);
                $providerType->clave = $request['clave'];
                $providerType->description = $request['description'];
                $providerType->id_provider_category = $request['id_provider_category'];
                $providerType->estatus = ($request['estatus'] == "on")?1:0;
                $message = "Registro Actualizado";       
            }
                $providerType->save();
            if($request['id_provider_type_redirect'] == 'true'){
                $providerTypes = ProviderType::all();
                $providerCategories = ProviderCategory::all()->where('estatus',1);
                $providerCategoriesAll = ProviderCategory::all();
                return view('provider-type.index')
                ->with('providerTypes',$providerTypes)
                ->with('providerCategoriesAll',$providerCategoriesAll)
                ->with('providerCategories',$providerCategories)
                ->withSuccess($message);
             }else{
                return ProviderType::all();
            }
        }catch (QueryException $e){
            $providerTypes = ProviderType::all();
            $providerCategories = ProviderCategory::all()->where('estatus',1);
            $providerCategoriesAll = ProviderCategory::all();
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('provider-type.index')
            ->with('providerTypes',$providerTypes)
            ->with('providerCategoriesAll',$providerCategoriesAll)
            ->with('providerCategories',$providerCategories)
            ->withErrors([$message]);
       }
    }

    /**
     * Action for delete ProviderType
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try{
    	   $providerType = ProviderType::findOrFail($id);
    	   $providerType->delete();
           $providerTypes = ProviderType::all();
           $providerCategories = ProviderCategory::all()->where('estatus',1);
           $providerCategoriesAll = ProviderCategory::all();
           return view('provider-type.index')
            ->with('providerTypes',$providerTypes)
            ->with('providerCategoriesAll',$providerCategoriesAll)
            ->with('providerCategories',$providerCategories)
            ->withErrors("Regitro Borrado");
        }catch (QueryException $e){
            $providerTypes = ProviderType::all();
            $providerCategories = ProviderCategory::all()->where('estatus',1);
            $providerCategoriesAll = ProviderCategory::all();
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('provider-type.index')
            ->with('providerTypes',$providerTypes)
            ->with('providerCategoriesAll',$providerCategoriesAll)
            ->with('providerCategories',$providerCategories)
            ->withErrors([$message]);
       }
    }

     /**
     * Action for ProviderType by category
     *
     * @return \Illuminate\Http\Response
     */
    public function category($id)
    {
        $providerTypes = ProviderType::all()->where('estatus', 1)->where('id_provider_category', $id);
        return $providerTypes;
    }

         /**
     * Action search if the data exist in the bd.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if($request['id'] != NULL){
            $providerType = ProviderType::where($request['column'], 'like', $request['val'])
            ->where('id_provider_type', '!=', $request['id'])->get();
        }else{
            $providerType = ProviderType::where($request['column'], 'like', $request['val'])->get();
        }

        return $providerType;
    }

}
