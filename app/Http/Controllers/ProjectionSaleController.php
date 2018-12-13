<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\ProjectionSale;
use App\ProjectionSaleDetail;
use App\DetailSale;
use App\Product;
use DB;
use App\Quotation;

class ProjectionSaleController extends Controller
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
    		$projectionSales = ProjectionSale::all();
    		return view('projection-sale.index')
    		->with('projectionSales',$projectionSales);
    	}catch (QueryException $e){
    		$projectionSale = ProjectionSale::all();
			$message = $e->errorInfo[1] ."-".$e->errorInfo[2];
			return view('projection-sale.index')
            ->with('projectionSale',$projectionSale)
            ->withErrors([$message]);
    	}
    }

    /**
     * Show the form for create new ProjectionSale
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $projectSale = new ProjectionSale();
        $projectionSaleDetails = new ProjectionSaleDetail();
        return view('projection-sale.form')
        ->with('projectSale',$projectSale)
        ->with('projectionSaleDetails',$projectionSaleDetails);
    }

    /**
     * Show the form for edit ProjectionSale
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $projectSale = ProjectionSale::findOrFail($id);
        $projectionSaleDetails = ProjectionSaleDetail::all()->where('id_projection_sale',$id);
        return view('projection-sale.index')
        ->with('projectSale',$projectSale)
        ->with('projectionSaleDetails',$projectionSaleDetails);
    }

    /**
     * Action for save ProjectionSale
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
    	DB::beginTransaction();
        try {
            $id = $request['id_projection_sale'];
            if($id == NULL){
                $projectionSale = new ProjectionSale();
    	        $projectionSale->folio = $request['folio'];
    	        $projectionSale->date_initial = $request['date_initial'];
    	        $projectionSale->date_end = $request['date_end'];
    	        $projectionSale->sale_sa = $request['sale_sa'];
    	        $projectionSale->cost_sa = $request['cost_sa'];
    	        $projectionSale->sale_proj = $request['sale_proj'];
    	        $projectionSale->cost_proj = $request['cost_proj'];
    	        $projectionSale->variation = $request['variation'];
    	        $projectionSale->estatus = ($request['estatus'] == "on")?1:0;
    	        //$projectionSale->autorization = ($request['autorization'] == "on")?1:0;
                $message = "Registro Creado";
            }else{
                $projectionSale = ProjectionSale::findOrFail($id);
    			$projectionSale->folio = $request['folio'];
    	        $projectionSale->date_initial = $request['date_initial'];
    	        $projectionSale->date_end = $request['date_end'];
    	        $projectionSale->sale_sa = $request['sale_sa'];
    	        $projectionSale->cost_sa = $request['cost_sa'];
    	        $projectionSale->sale_proj = $request['sale_proj'];
    	        $projectionSale->cost_proj = $request['cost_proj'];
    	        $projectionSale->variation = $request['variation'];
    	        $projectionSale->estatus = ($request['estatus'] == "on")?1:0;
    	        //$projectionSale->autorization = ($request['autorization'] == "on")?1:0;

    	        $projectionSaleDetails = ProjectionSaleDetail::all()->where('id_projection_sale', $id);
                
                foreach($projectionSaleDetails as $projectionSaleDetailTable){
                    $projectionSaleDetail = ProjectionSaleDetail::findOrFail($projectionSaleDetailTable->id_projection_sale);
                    $projectionSaleDetail->delete();
                }

                $message = "Registro Actualizado";    
            }
            $projectionSale->save();

             foreach(json_decode($request['projectionSaleDetails'], true) as $projectionSaleDetailEntry){
                if($projectionSaleDetailEntry != NULL){
                    $projectionSaleDetail = new ProjectionSaleDetail();
                    $projectionSaleDetail->id_projection_sale = $projectionSale->id_projection_sale;
                    $projectionSaleDetail->id_supply = $projectionSaleDetailEntry["id_supply"];
                    $projectionSaleDetail->quantity_sold = $projectionSaleDetailEntry["quantity_sold"];
                    $projectionSaleDetail->quantity_proyec = $projectionSaleDetailEntry["quantity_proyec"];
                    $projectionSaleDetail->price_sale = $projectionSaleDetailEntry["price_sale"];
                    $projectionSaleDetail->price_proyec = $projectionSaleDetailEntry["price_proyec"];
                    $projectionSaleDetail->price_without_taxes = $projectionSaleDetailEntry["price_without_taxes"];
                    $projectionSaleDetail->entry = $projectionSaleDetailEntry["entry"];
                    $projectionSaleDetail->entry_proyec = $projectionSaleDetailEntry["entry_proyec"];
                    $projectionSaleDetail->cost = $projectionSaleDetailEntry["cost"];
                    $projectionSaleDetail->cost_proyec = $projectionSaleDetailEntry["cost_proyec"];
                    $projectionSaleDetail->cost_percent_proyec = $projectionSaleDetailEntry["cost_percent_proyec"];
                    $projectionSaleDetail->cost_total_proyec = $projectionSaleDetailEntry["cost_total_proyec"];
                    $projectionSaleDetail->expense_proyec = $projectionSaleDetailEntry["expense_proyec"];
                    $projectionSaleDetail->utility_proyec = $projectionSaleDetailEntry["utility_proyec"];
                    $projectionSaleDetail->utility_total_proyec = $projectionSaleDetailEntry["utility_total_proyec"];

                    $projectionSaleDetail->save();
                }
            }

            DB::commit();
            if($request['id_projection_sale_redirect'] == 'true'){
            	$projectionSale = ProjectionSale::all();
    			return view('projection-sale.index')
    			->with('projectionSale',$projectionSale)
                ->withSuccess($message);
            }else{
                return ProjectionSale::all()->where('estatus',1);
            }
         }catch (QueryException $e){
         	DB::rollBack();
            $projectionSale = ProjectionSale::all();
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('projection-sale.index')
            ->with('projectionSale',$projectionSale)
            ->withErrors([$message]);
       }
    }

    /**
     * Action for delete ProjectionSale
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
    	DB::beginTransaction();
        try {
        	$projectionSaleDetails = ProjectionSaleDetail::all()->where('id_projection_sale', $id);
            foreach($projectionSaleDetails as $projectionSaleDetailTable){
                $projectionSaleDetail = ProjectionSaleDetail::findOrFail($projectionSaleDetailTable->id_projection_sale);
                $projectionSaleDetail->delete();
            }

            $projectionSale = ProjectionSale::findOrFail($id);
            $projectionSale->delete();
            DB::commit();

            $projectionSale = ProjectionSale::all();
            return view('projection-sale.index')
            ->with('projectionSale',$projectionSale)
            ->withSuccess('Registro Borrado');
        }catch (QueryException $e){
        	DB::rollBack();
            $projectionSale = ProjectionSale::all();
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('projection-sale.index')
            ->with('projectionSale',$projectionSale)
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
            $projectionSale = ProjectionSale::where($request['column'], 'like', $request['val'])
            ->where('id_projection_sale', '!=', $request['id'])->get();
        }else{
            $projectionSale = ProjectionSale::where($request['column'], 'like', $request['val'])->get();
        }
        return $projectionSale;
    }


    public function detailSales(Request $request){
            $detail_sales = array();
            foreach (DB::table('detail_sales')
                                ->selectRaw('clave_product')
                                ->selectRaw(DB::raw('SUM(unity_sales) AS quantity, clave_product'))
                                ->selectRaw(DB::raw('SUM(sales_net) AS total , clave_product'))
                                ->whereBetween('date', [$request['date_initial'], $request['date_end']])
                                ->where('company', $request['company'])
                                ->groupBy('clave_product')->cursor() as $key => $detail_sale) {

                                foreach (DB::table('products')
                                                ->selectRaw('clave')
                                                ->selectRaw('description')
                                                ->selectRaw('price_sale')
                                                ->selectRaw('price_sale_iva')
                                                ->selectRaw('cost_sale')
                                                ->selectRaw('expenditure_operative')
                                                ->where('company', $request['company'])
                                                ->where('clave', $detail_sale->clave_product)
                                                ->cursor()as $key => $product) {

                                    $detail_sale->price_sale = $product->price_sale;
                                    $detail_sale->price_sale_iva = $product->price_sale_iva;
                                    $detail_sale->description = $product->description;
                                    
                                    $detail_sale->quantity_proj = 0.00;
                                    $detail_sale->price_proj = 0.00;
                                    $detail_sale->income_proj = 0.00;

                                    $detail_sale->cost = ($product->cost_sale == NULL)?0.00:floatval($product->cost_sale);
                                    $detail_sale->cost_percent = ($product->cost_sale == NULL)?0.00:number_format((floatval($product->cost_sale)/floatval($product->price_sale)) * 100, 2);
                                    $detail_sale->cost_total = ($product->cost_sale == NULL)?0.00:number_format((floatval($product->cost_sale)/floatval($detail_sale->quantity)) * 100, 2);
                                    $detail_sale->expenditure = $product->expenditure_operative;
                                    $detail_sale->utility = ($product->cost_sale == NULL)?0.00:number_format((floatval($product->cost_sale)/floatval($product->price_sale)) * 100, 2);
                                   $detail_sale->total_utility = $product->price_sale_iva;
                                }
                                $detail_sales[] = $detail_sale;
            }
                /*SELECT 
                clave_product, dish, ROUND(SUM(unity_sales),2) AS quantity, ROUND(total_sale,2) AS price_without_iva, ROUND(sales_net,2) AS price_with_iva, ROUND(SUM(sales_net),2) AS total 
                FROM `detail_sales`
                WHERE date 
                BETWEEN '07/12/2018 00:00:00' and '07/12/2018 23:59:59' 
                and company = 'Churrasco' 
                GROUP BY clave_product*/
        return $detail_sales;
    }
}