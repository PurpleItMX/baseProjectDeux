<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\ServiceType;
use App\ServiceCategory;

class ServiceTypeController extends Controller
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
        $serviceTypes = ServiceType::all();
        $serviceCategoriesAll = ServiceCategory::all();
        $serviceCategories = ServiceCategory::all()->where('estatus',1);
        return view('service-type.index')
        ->with('serviceTypes',$serviceTypes)
        ->with('serviceCategories',$serviceCategories)
        ->with('serviceCategoriesAll',$serviceCategoriesAll);
    }

     /**
     * Show the form for create new ServiceType.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){}

    /**
     * Show the form for edit ServiceType.
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        return $serviceCategoriesAllType = ServiceType::findOrFail($id);
    }

    /**
     * Action for save ServiceType
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        try{
            $id = $request['id_service_type'];
            if($id == NULL){
                $serviceType = new ServiceType();
    	        $serviceType->clave = $request['clave'];
    	        $serviceType->description = $request['description'];
    	        $serviceType->id_service_category = $request['id_service_category'];
    	        $serviceType->estatus = ($request['estatus'] == "on")?1:0;
                $message = "Registro Creado";
            }else{
                $serviceType = ServiceType::findOrFail($id);
                $serviceType->clave = $request['clave'];
                $serviceType->description = $request['description'];
                $serviceType->id_service_category = $request['id_service_category'];
                $serviceType->estatus = ($request['estatus'] == "on")?1:0;   
                $message = "Registro Actualizado";    
            }
                $serviceType->save();
            if($request['id_service_type_redirect'] == 'true'){
                return redirect('/service-types')->with('success', $message);
             }else{
                return ServiceType::all()->where('estatus',1);
            }
        }catch (QueryException $e){
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return redirect('/service-types')->with('error', $message);
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
            $serviceType = ServiceType::findOrFail($id);
            $serviceType->delete();
            return redirect('/service-types')->with('success', 'Registro Borrado');
        }catch (QueryException $e){
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return redirect('/service-types')->with('error', $message);
       }
    }

     /**
     * Action for SupplyType by category
     *
     * @return \Illuminate\Http\Response
     */
    public function category($id)
    {
        $serviceTypes = ServiceType::all()->where('estatus', 1)->where('id_service_type', $id);
        return $serviceTypes;
    }

    /**
     * Action search if the data exist in the bd.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if($request['id'] != NULL){
            $serviceType = ServiceType::where($request['column'], 'like', $request['val'])
            ->where('id_service_type', '!=', $request['id'])->get();
        }else{
            $serviceType = ServiceType::where($request['column'], 'like', $request['val'])->get();
        }

        return $serviceType;
    }
}
