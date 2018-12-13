<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supply;
use App\Warehouse;
use App\Season;
use App\SupplyType;
use App\SupplyCategory;
use App\SupplyWarehouse;

class SupplyController extends Controller
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
            $supplies = Supply::all();
            $supplyCategories = SupplyCategory::all()->where('estatus',1);
            $seasons = Season::all()->where('estatus',1);
            $supplyTypes = SupplyType::all()->where('estatus',1);
            $warehouses = Warehouse::all()->where('estatus',1);
            return view('supply.index')
            ->with('supplies',$supplies)
            ->with('seasons',$seasons)
            ->with('supplyCategories',$supplyCategories)
            ->with('warehouses',$warehouses)
            ->with('supplyTypes',$supplyTypes);
        }catch (QueryException $e){
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('supply.index')
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
        $return["supply"] = Supply::findOrFail($id);
        $return["supplyWarehouse"] = SupplyWarehouse::all()->where('id_supply', $id);
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
            $id = $request['id_supply'];
            if($id == NULL){
                $supply = new Supply();
                $supply->clave = $request['clave'];
                $supply->udm = $request['umd'];
                $supply->description = $request['description'];
                $supply->id_supply_category = $request['id_supply_category'];
                $supply->id_supply_type = $request['id_supply_type'];
                $supply->id_season = $request['id_season'];
                $supply->performance = $request['performance'];
                $supply->is_inventorial = ($request['is_inventorial'] == "on")?1:0;
                $supply->is_product = ($request['is_product'] == "on")?1:0;
                $supply->is_auditable = ($request['is_auditable'] == "on")?1:0;
                $supply->is_direct_purchase = ($request['is_direct_purchase'] == "on")?1:0;
                $supply->tolerance = $request['tolerance'];
                $supply->stock_fixed = $request['stock_fixed'];
                $supply->stock_variable = $request['stock_variable'];
                $supply->minimal_presentation = $request['minimal_presentation'];
                $supply->type = $request['type'];
                $supply->id_provider_primary = 1; //$request['id_provider_primary'];
                $supply->id_provider_second = 1; $request['id_provider_second'];
                $supply->id_provider_third = 1; $request['id_provider_third'];
                $supply->estatus = ($request['estatus'] == "on")?1:0;
                $message = "Registro Creado";
            }else{
                $supply  = Supply::findOrFail($id);
                $supply->clave = $request['clave'];
                $supply->udm = $request['umd'];
                $supply->description = $request['description'];
                $supply->id_supply_category = $request['id_supply_category'];
                $supply->id_supply_type = $request['id_supply_type'];
                $supply->id_season = $request['id_season'];
                $supply->performance = $request['performance'];
                $supply->is_inventorial = ($request['is_inventorial'] == "on")?1:0;
                $supply->is_product = ($request['is_product'] == "on")?1:0;
                $supply->is_auditable = ($request['is_auditable'] == "on")?1:0;
                $supply->is_direct_purchase = ($request['is_direct_purchase'] == "on")?1:0;
                $supply->tolerance = $request['tolerance'];
                $supply->stock_fixed = $request['stock_fixed'];
                $supply->stock_variable = $request['stock_variable'];
                $supply->minimal_presentation = $request['minimal_presentation'];
                $supply->type = $request['type'];
                $supply->id_provider_primary = 1; //$request['id_provider_primary'];
                $supply->id_provider_second = 1; $request['id_provider_second'];
                $supply->id_provider_third = 1; $request['id_provider_third'];
                $supply->estatus = ($request['estatus'] == "on")?1:0;

                $supplyWarehouses = SupplyWarehouse::all()->where('id_supply', $id);
                
                foreach($supplyWarehouses as $supplyWarehouseTable){
                    $supplyWarehouse = SupplyWarehouse::findOrFail($supplyWarehouseTable->id_supply_warehouse);
                    $supplyWarehouse->delete();
                }
                $message = "Registro Actualizado";
            }
            $supply->save();

            foreach(json_decode($request['supply_warehouse'], true) as $warehouse){
                if($warehouse != NULL){
                    $supplyWarehouse = new SupplyWarehouse();
                    $supplyWarehouse->id_supply = $supply->id_supply;
                    $supplyWarehouse->id_warehouse = $warehouse["id_warehouse"];
                    $supplyWarehouse->percent = $warehouse["porcent"];
                    $supplyWarehouse->save();
                }
            }

            if($request['id_supply_redirect'] == 'true'){
                $supplies = Supply::all();
                $supplyCategories = SupplyCategory::all()->where('estatus',1);
                $seasons = Season::all()->where('estatus',1);
                $supplyTypes = SupplyType::all()->where('estatus',1);
                $warehouses = Warehouse::all()->where('estatus',1);
                return view('supply.index')
                ->with('supplies',$supplies)
                ->with('seasons',$seasons)
                ->with('supplyCategories',$supplyCategories)
                ->with('warehouses',$warehouses)
                ->with('supplyTypes',$supplyTypes)
                ->withSuccess($message);
            }else{
                return Supply::all();
            }
        }catch (QueryException $e){
            $supplies = Supply::all();
            $supplyCategories = SupplyCategory::all()->where('estatus',1);
            $seasons = Season::all()->where('estatus',1);
            $supplyTypes = SupplyType::all()->where('estatus',1);
            $warehouses = Warehouse::all()->where('estatus',1);
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('supply.index')
            ->with('supplies',$supplies)
            ->with('seasons',$seasons)
            ->with('supplyCategories',$supplyCategories)
            ->with('warehouses',$warehouses)
            ->with('supplyTypes',$supplyTypes)
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
            $supply = Supply::findOrFail($id);
            $supply->delete();
            $supplies = Supply::all();
            $supplyCategories = SupplyCategory::all()->where('estatus',1);
            $seasons = Season::all()->where('estatus',1);
            $supplyTypes = SupplyType::all()->where('estatus',1);
            $warehouses = Warehouse::all()->where('estatus',1);
            return view('supply.index')
            ->with('supplies',$supplies)
            ->with('seasons',$seasons)
            ->with('supplyCategories',$supplyCategories)
            ->with('warehouses',$warehouses)
            ->with('supplyTypes',$supplyTypes)
            ->withSuccess('Registro Borrado');
        }catch (QueryException $e){
            $supplies = Supply::all();
            $supplyCategories = SupplyCategory::all()->where('estatus',1);
            $seasons = Season::all()->where('estatus',1);
            $supplyTypes = SupplyType::all()->where('estatus',1);
            $warehouses = Warehouse::all()->where('estatus',1);
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('supply.index')
            ->with('supplies',$supplies)
            ->with('seasons',$seasons)
            ->with('supplyCategories',$supplyCategories)
            ->with('warehouses',$warehouses)
            ->with('supplyTypes',$supplyTypes)
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
            $supply = Supply::where($request['column'], 'like', $request['val'])
            ->where('id_supply', '!=', $request['id'])->get();
        }else{
            $supply = Supply::where($request['column'], 'like', $request['val'])->get();
        }

        return $supply;
    }
}
