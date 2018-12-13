<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\ProductType;
use App\ProductCategory;

class ProductTypeController extends Controller
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
            $productTypes = ProductType::all();
            $productCategoriesAll = ProductCategory::all();
            $productCategories = ProductCategory::all()->where('estatus',1);
            return view('product-type.index')
            ->with('productTypes',$productTypes)
            ->with('productCategories',$productCategories)
            ->with('productCategoriesAll',$productCategoriesAll);
        }catch (QueryException $e){
            $productTypes = ProductType::all();
            $productCategoriesAll = ProductCategory::all();
            $productCategories = ProductCategory::all()->where('estatus',1);
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('product-type.index')
            ->with('productTypes',$productTypes)
            ->with('productCategories',$productCategories)
            ->with('productCategoriesAll',$productCategoriesAll)
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
        return $productType = ProductType::findOrFail($id);
    }

    /**
     * Action for save ProductType
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        try{
            $id = $request['id_product_type'];
            if($id == NULL){
                $productType = new ProductType();
    	        $productType->clave = $request['clave'];
    	        $productType->description = $request['description'];
    	        $productType->id_product_category = $request['id_product_category'];
    	        $productType->estatus = ($request['estatus'] == "on")?1:0;
                $message = "Registro Creado";
            }else{
                $productType = ProductType::findOrFail($id);
                $productType->clave = $request['clave'];
                $productType->description = $request['description'];
                $productType->id_product_category = $request['id_product_category'];
                $productType->estatus = ($request['estatus'] == "on")?1:0;   
                $message = "Registro Actualizado";    
            }
                $productType->save();
            if($request['id_product_type_redirect'] == 'true'){
                $productCategoriesAll = ProductCategory::all();
                $productTypes = ProductType::all();
                $productCategories = ProductCategory::all()->where('estatus',1);
                return view('product-type.index')
                ->with('productTypes',$productTypes)
                ->with('productCategories',$productCategories)
                ->with('productCategoriesAll',$productCategoriesAll)
                ->withSuccess($message);
             }else{
                return ProductType::all()->where('estatus',1);
            }
        }catch (QueryException $e){
            $supplyCategoriesAll = SupplyCategory::all();
            $supplyTypes = ProductType::all();
            $supplyCategories = SupplyCategory::all()->where('estatus',1);
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('product-type.index')
            ->with('productTypes',$productTypes)
            ->with('productCategories',$productCategories)
            ->with('productCategoriesAll',$productCategoriesAll)
            ->withErrors([$message]);
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
            $supplyType = SupplyType::findOrFail($id);
            $supplyType->delete();
            $supplyTypes = SupplyType::all();
            $supplyCategoriesAll = SupplyCategory::all();
            $supplyCategories = SupplyCategory::all()->where('estatus',1);
            return view('supply-type.index')
            ->with('supplyTypes',$supplyTypes)
            ->with('supplyCategories',$supplyCategories)
            ->with('supplyCategoriesAll',$supplyCategoriesAll)
            ->withSuccess('Registro Borrado');
        }catch (QueryException $e){
            $supplyTypes = SupplyType::all();
            $supplyCategoriesAll = SupplyCategory::all();
            $supplyCategories = SupplyCategory::all()->where('estatus',1);
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('supply-type.index')
            ->with('supplyTypes',$supplyTypes)
            ->with('supplyCategories',$supplyCategories)
            ->with('supplyCategoriesAll',$supplyCategoriesAll)
            ->withErrors([$message]);
       }
    }

     /**
     * Action for SupplyType by category
     *
     * @return \Illuminate\Http\Response
     */
    public function category($id)
    {
        $productTypes = ProductType::all()->where('estatus', 1)->where('id_product_category', $id);
        return $productTypes;
    }

    /**
     * Action search if the data exist in the bd.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if($request['id'] != NULL){
            $productType = ProductType::where($request['column'], 'like', $request['val'])
            ->where('id_product_type', '!=', $request['id'])->get();
        }else{
            $productType = ProductType::where($request['column'], 'like', $request['val'])->get();
        }

        return $productType;
    }
}
