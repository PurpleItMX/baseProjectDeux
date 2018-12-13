<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\ProductCategory;

class ProductCategoryController extends Controller
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
            $productCategories = ProductCategory::all();
            return view('product-category.index')
            ->with('productCategories',$productCategories);
        }catch (QueryException $e){
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('product-category.index')
            ->withErrors([$message]);
        }

    }

     /**
     * Show the form for create new ProductCategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){}

    /**
     * Show the form for edit ProductCategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        return $productCategory = ProductCategory::findOrFail($id);
    }

    /**
     * Action for save ProductCategory
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        try {
            $id = $request['id_product_category'];
            if($id == NULL){
                $productCategory = new ProductCategory();
    	        $productCategory->clave = $request['clave'];
    	        $productCategory->description = $request['description'];
    	        $productCategory->variant = $request['variant'];
    	        $productCategory->estatus = ($request['estatus'] == "on")?1:0;
                $message = "Registro Creado";
            }else{
                $productCategory  = ProductCategory::findOrFail($id);
                $productCategory->clave = $request['clave'];
    	        $productCategory->description = $request['description'];
    	        $productCategory->variant = $request['variant'];
    	        $productCategory->estatus = ($request['estatus'] == "on")?1:0;
                $message = "Registro Actualizado";
            }
                $productCategory->save();
            
            if($request['id_product_category_redirect'] == 'true'){
                $productCategories = ProductCategory::all();
                return view('product-category.index')
                ->with('productCategories',$productCategories)
                ->withSuccess($message);
            }else{
                return ProductCategory::all()->where('estatus',1);
            }
        }catch (QueryException $e){
            $productCategories = ProductCategory::all();
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('product-category.index')
            ->with('productCategories',$productCategories)
            ->withErrors([$message]);
       }
    }

    /**
     * Action for delete ProductCategory
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            $productCategory = ProductCategory::findOrFail($id);
            $productCategory->delete();
            $productCategories = ProductCategory::all();
            return view('product-category.index')
            ->with('productCategories',$productCategories)
            ->withSuccess('Registro Borrado');
        }catch (QueryException $e){
            $productCategories = ProductCategory::all();
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return view('product-category.index')
            ->with('productCategories',$productCategories)
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
            $productCategory = ProductCategory::where($request['column'], 'like', $request['val'])
            ->where('id_product_category', '!=', $request['id'])->get();
        }else{
            $productCategory = ProductCategory::where($request['column'], 'like', $request['val'])->get();
        }

        return $productCategory;
    }
}
