<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Provider;
use App\SupplyCategory;

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
        $supplyCategories = SupplyCategory::all();
        return view('provider.index')
        ->with('providers',$providers)
        ->with('supplyCategories',$supplyCategories);
    }

     /**
     * Show the form for create new SupplyType.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Show the form for edit SupplyType.
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        return $provider = Provider::findOrFail($id);
        /*return view('supply-type.form')
        ->with('supplyType',$supplyType)
        ->with('supplyCategories',$supplyCategories);*/
    }

    /**
     * Action for save SupplyType
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $id = $request['id_provider'];
        if($id == NULL){
            $provider = new Provider();
            $provider->clave = $request['clave'];
            $provider->rfc = $request['rfc'];
            $provider->name = $request['name'];
            $provider->name_commercial = $request['name_commercial'];
            $provider->type = $request['type'];
            $provider->street = $request['street'];
            $provider->number_ext = $request['number_ext'];
            $provider->number_int = $request['number_int'];
            $provider->colony = $request['colony'];
            $provider->city = $request['city'];
            $provider->state = $request['state'];
            $provider->country = $request['country'];
            $provider->zip_code = $request['zip_code'];
            $provider->phone = $request['phone'];
            $provider->email = "matthew890513@gmail.com";/*$request['email'];*/
            $provider->estatus = ($request['estatus'] == "on")?1:0;
        }else{
            $provider = Provider::findOrFail($id);
            $provider->clave = $request['clave'];
            $provider->rfc = $request['rfc'];
            $provider->name = $request['name'];
            $provider->name_commercial = $request['name_commercial'];
            $provider->type = $request['type'];
            $provider->street = $request['street'];
            $provider->number_ext = $request['number_ext'];
            $provider->number_int = $request['number_int'];
            $provider->colony = $request['colony'];
            $provider->city = $request['city'];
            $provider->state = $request['state'];
            $provider->country = $request['country'];
            $provider->zip_code = $request['zip_code'];
            $provider->phone = $request['phone'];
            $provider->email = "matthew890513@gmail.com";/*$request['email'];*/
            $provider->estatus = ($request['estatus'] == "on")?1:0;      
        }
            $provider->save();
        if($request['id_provider_redirect'] == 'true'){
            return redirect()->action('ProviderController@index');
         }else{
            return Provider::all();
        }
    }

    /**
     * Action for delete SupplyType
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
    	SupplyType::deleteById($id);
        return redirect()->action('SupplyTypeController@index');
    }
}
