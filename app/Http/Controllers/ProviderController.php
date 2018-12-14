<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Provider;
use App\ProviderCategory;
use App\ProviderType;

class ProviderController extends Controller
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
        $providers = Provider::all();
        $providerCategories = ProviderCategory::all();
        $providerTypes = ProviderType::all();
        return view('provider.index')
        ->with('providers',$providers)
        ->with('providerCategories',$providerCategories)
        ->with('providerTypes',$providerTypes);
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
        return $provider = Provider::findOrFail($id);
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
            $id = $request['id_provider'];
            if($id == NULL){
                $provider = new Provider();
                $provider->clave = $request['clave'];
                $provider->rfc = $request['rfc'];
                $provider->name = $request['name'];
                $provider->name_commercial = $request['name_commercial'];
                $provider->type = $request['type'];
                $provider->id_provider_category = $request['id_provider_category'];
                $provider->id_provider_type = $request['id_provider_type'];
                $provider->street = $request['street'];
                $provider->number_ext = $request['number_ext'];
                $provider->number_int = $request['number_int'];
                $provider->colony = $request['colony'];
                $provider->city = $request['city'];
                $provider->state = $request['state'];
                $provider->country = $request['country'];
                $provider->zip_code = $request['zip_code'];
                $provider->phone = $request['phone'];
                $provider->email = $request['email'];
                $provider->estatus = ($request['estatus'] == "on")?1:0;
                $message = "Registro Creado";
            }else{
                $provider = Provider::findOrFail($id);
                $provider->clave = $request['clave'];
                $provider->rfc = $request['rfc'];
                $provider->name = $request['name'];
                $provider->name_commercial = $request['name_commercial'];
                $provider->type = $request['type'];
                $provider->id_provider_category = $request['id_provider_category'];
                $provider->id_provider_type = $request['id_provider_type'];
                $provider->street = $request['street'];
                $provider->number_ext = $request['number_ext'];
                $provider->number_int = $request['number_int'];
                $provider->colony = $request['colony'];
                $provider->city = $request['city'];
                $provider->state = $request['state'];
                $provider->country = $request['country'];
                $provider->zip_code = $request['zip_code'];
                $provider->phone = $request['phone'];
                $provider->email = $request['email'];
                $provider->estatus = ($request['estatus'] == "on")?1:0;    
                $message = "Registro Actualizado";  
            }
                $provider->save();
            if($request['id_provider_redirect'] == 'true'){
                return redirect('/providers')->with('success', $message);
             }else{
                return Provider::all();
            }
        }catch (QueryException $e){
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return redirect('/providers')->with('error', $message);
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
    	    $provider = Provider::findOrFail($id);
            $provider->delete();
            return redirect('/providers')->with('error', 'Registro Borrado');
        }catch (QueryException $e){
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return redirect('/providers')->with('error', $message);
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
            $provider = Provider::where($request['column'], 'like', $request['val'])
            ->where('id_provider', '!=', $request['id'])->get();
        }else{
            $provider = Provider::where($request['column'], 'like', $request['val'])->get();
        }

        return $provider;
    }
}
