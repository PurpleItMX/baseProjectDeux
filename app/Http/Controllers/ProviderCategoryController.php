<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\ProviderCategory;

class ProviderCategoryController extends Controller
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
            $providerCategories = ProviderCategory::all();
            return view('provider-category.index')
            ->with('providerCategories',$providerCategories);
        }catch (QueryException $e){
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('provider-type.index')
            ->withErrors([$message]);
        }
    }

     /**
     * Show the form for create new ProviderCategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){}

    /**
     * Show the form for edit ProviderCategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        return $providerCategory = ProviderCategory::findOrFail($id);
    }

    /**
     * Action for save ProviderCategory
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        try{
            $id = $request['id_provider_category'];
            if($id == NULL){
                $providerCategory = new ProviderCategory();
    	        $providerCategory->clave = $request['clave'];
    	        $providerCategory->description = $request['description'];
    	        $providerCategory->estatus = ($request['estatus'] == "on")?1:0;
                $message = "Registro Creado";
            }else{
                $providerCategory  = ProviderCategory::findOrFail($id);
                $providerCategory->clave = $request['clave'];
    	        $providerCategory->description = $request['description'];
    	        $providerCategory->estatus = ($request['estatus'] == "on")?1:0;
                $message = "Registro Actualizado";
            }
                $providerCategory->save();
            if($request['id_provider_category_redirect'] == 'true'){
                $providerCategories = ProviderCategory::all();
                return view('provider-category.index')
                ->with('providerCategories',$providerCategories)
                ->withSuccess($message);
            }else{
                return ProviderCategory::all();
            }
        }catch (QueryException $e){
            $providerCategories = ProviderCategory::all();
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('provider-category.index')
            ->with('providerCategories',$providerCategories)
            ->withErrors([$message]);
       }
    }

    /**
     * Action for delete ProviderCategory
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            $providerCategory = ProviderCategory::findOrFail($id);
            $providerCategory->delete();
            $providerCategories = ProviderCategory::all();
            return view('provider-category.index')
            ->with('providerCategories',$providerCategories)
            ->withSuccess('Registro Borrado');
        }catch (QueryException $e){
            $providerCategories = ProviderCategory::all();
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('provider-category.index')
            ->with('providerCategories',$providerCategories)
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
            $providerCategory = ProviderCategory::where($request['column'], 'like', $request['val'])
            ->where('id_provider_category', '!=', $request['id'])->get();
        }else{
            $providerCategory = ProviderCategory::where($request['column'], 'like', $request['val'])->get();
        }

        return $providerCategory;
    }
}
