<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Service;
use App\ServiceCategory;

class ServiceController extends Controller
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
            $services = Service::all();
            $serviceCategories = ServiceCategory::all()->where('estatus', 1);
            return view('service.index')
            ->with('services',$services)
            ->with('serviceCategories',$serviceCategories);
        }catch (QueryException $e){
            $services = Service::all();
            $serviceCategories = ServiceCategory::all()->where('estatus', 1);
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('service.index')
            ->with('services',$services)
            ->with('serviceCategories',$serviceCategories)
            ->withErrors([$message]);
        }
    }

     /**
     * Show the form for create new Service.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){}

    /**
     * Show the form for edit Service.
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        return $services = Service::findOrFail($id);
    }

    /**
     * Action for save Service
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        try{
            $id = $request['id_service'];
            if($id == NULL){
                $service = new Service();
    	        $service->clave = $request['clave'];
    	        $service->description = $request['description'];
                $service->udm = $request['udm'];
                $service->id_service_category = $request['id_service_category'];
                $service->id_service_type = $request['id_service_type'];
                $service->apportionment = $request['apportionment'];
                $service->percentage_apportionment = $request['percentage_apportionment'];
    	        $service->estatus = ($request['estatus'] == "on")?1:0;
                $message = "Registro Creado";
            }else{
                $service  = Service::findOrFail($id);
                $service->clave = $request['clave'];
                $service->description = $request['description'];
                $service->udm = $request['udm'];
                $service->id_service_category = $request['id_service_category'];
                $service->id_service_type = $request['id_service_type'];
                $service->apportionment = $request['apportionment'];
                $service->percentage_apportionment = $request['percentage_apportionment'];
                $service->estatus = ($request['estatus'] == "on")?1:0;
                $message = "Registro Actualizado";
            }
                $service->save();
            if($request['id_service_redirect'] == 'true'){
                $services = Service::all();
                $serviceCategories = ServiceCategory::all()->where('estatus', 1);
                return view('service.index')
                ->with('services',$services)
                ->with('serviceCategories',$serviceCategories)
                ->withSuccess($message);
            }else{
                return Service::all();
            }
        }catch (QueryException $e){
            $services = Service::all();
            $serviceCategories = ServiceCategory::all()->where('estatus', 1);
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('service.index')
            ->with('services',$services)
            ->with('serviceCategories',$serviceCategories)
            ->withErrors([$message]);
       }
    }

    /**
     * Action for delete Service
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            $service = Service::findOrFail($id);
            $service->delete();
            $services = Service::all();
            $serviceCategories = ServiceCategory::all()->where('estatus', 1);
            return view('service.index')
            ->with('services',$services)
            ->with('serviceCategories',$serviceCategories)
            ->withSuccess('Registro Borrado');
        }catch (QueryException $e){
            $services = Service::all();
            $serviceCategories = ServiceCategory::all()->where('estatus', 1);
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('service.index')
            ->with('services',$services)
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
            $service = Service::where($request['column'], 'like', $request['val'])
            ->where('id_service', '!=', $request['id'])->get();
        }else{
            $service = Service::where($request['column'], 'like', $request['val'])->get();
        }

        return $service;
    }
}
