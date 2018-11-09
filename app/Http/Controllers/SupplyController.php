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
     * Show the form for create new Warehouse.
     *
     * @return \Illuminate\Http\Response
     */
    public function new()
    {
    	$warehouses = Warehouse::all();
        return view('supplier.form')
        ->with('supply','')
        ->with('warehouses',$warehouses);
    }
}
