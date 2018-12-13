<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\ServiceCategory;

class ServiceCategoryController extends Controller
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
            $serviceCategories = ServiceCategory::all();
            return view('service-category.index')
            ->with('serviceCategories',$serviceCategories);
        }catch (QueryException $e){
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('service-type.index')
            ->withErrors([$message]);
        }
    }

     /**
     * Show the form for create new ServiceCategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){}

    /**
     * Show the form for edit ServiceCategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        return $serviceCategory = ServiceCategory::findOrFail($id);
    }

    /**
     * Action for save ServiceCategory
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        try{
            $id = $request['id_service_category'];
            if($id == NULL){
                $serviceCategory = new ServiceCategory();
    	        $serviceCategory->clave = $request['clave'];
    	        $serviceCategory->description = $request['description'];
    	        $serviceCategory->estatus = ($request['estatus'] == "on")?1:0;
                $message = "Registro Creado";
            }else{
                $serviceCategory  = ServiceCategory::findOrFail($id);
                $serviceCategory->clave = $request['clave'];
    	        $serviceCategory->description = $request['description'];
    	        $serviceCategory->estatus = ($request['estatus'] == "on")?1:0;
                $message = "Registro Actualizado";
            }
                $serviceCategory->save();
            if($request['id_service_category_redirect'] == 'true'){
                $serviceCategories = ServiceCategory::all();
                return view('service-category.index')
                ->with('serviceCategories',$serviceCategories)
                ->withSuccess($message);
            }else{
                return ServiceCategory::all();
            }
        }catch (QueryException $e){
            $serviceCategories = ServiceCategory::all();
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('service-category.index')
            ->with('serviceCategories',$serviceCategories)
            ->withErrors([$message]);
       }
    }

    /**
     * Action for delete ServiceCategory
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            $serviceCategory = ServiceCategory::findOrFail($id);
            $serviceCategory->delete();
            $serviceCategories = ServiceCategory::all();
            return view('service-category.index')
            ->with('serviceCategories',$serviceCategories)
            ->withSuccess('Registro Borrado');
        }catch (QueryException $e){
            $serviceCategories = ServiceCategory::all();
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('service-category.index')
            ->with('serviceCategories',$serviceCategories)
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
            $serviceCategory = ServiceCategory::where($request['column'], 'like', $request['val'])
            ->where('id_service_category', '!=', $request['id'])->get();
        }else{
            $serviceCategory = ServiceCategory::where($request['column'], 'like', $request['val'])->get();
        }

        return $serviceCategory;
    }
}
