<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductType;
use App\ProductCategory;

class ProductController extends Controller
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
        $products = Product::all();
        $productCategories = ProductCategory::all()->where('estatus',1);
        $productTypes = ProductType::all()->where('estatus',1);
        return view('product.index')
        ->with('products',$products)
        ->with('productCategories',$productCategories)
        ->with('productTypes',$productTypes);
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
        return $product = Product::findOrFail($id);
    }

    /**
     * Action for save PRoduct
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        try {
            $id = $request['id_product'];
            if($id == NULL){
                $product = new Product();
                $product->clave = $request['clave'];
                $product->udm = $request['umd'];
                $product->description = $request['description'];
                $product->id_product_category = $request['id_product_category'];
                $product->id_product_type = $request['id_product_type'];
                $product->price_sale = $request['price_sale'];
                $product->margen_category = $request['margen_category'];
                $product->margen_actually = $request['margen_actually'];
                $product->cost_sale = $request['cost_sale'];
                $product->expenditure_operative = $request['expenditure_operative'];
                $product->utility = $request['utility'];
                $product->iva = $request['iva'];
                $product->import_iva = $request['import_iva'];
                $product->price_sale_iva = $request['price_sale_iva'];
                $product->estatus = ($request['estatus'] == "on")?1:0;
                $message = "Registro Creado";
            }else{
                $product  = Product::findOrFail($id);
                $product->clave = $request['clave'];
                $product->udm = $request['umd'];
                $product->description = $request['description'];
                $product->id_product_category = $request['id_product_category'];
                $product->id_product_type = $request['id_product_type'];
                $product->price_sale = $request['price_sale'];
                $product->margen_category = $request['margen_category'];
                $product->margen_actually = $request['margen_actually'];
                $product->cost_sale = $request['cost_sale'];
                $product->expenditure_operative = $request['expenditure_operative'];
                $product->utility = $request['utility'];
                $product->iva = $request['iva'];
                $product->import_iva = $request['import_iva'];
                $product->price_sale_iva = $request['price_sale_iva'];
                $product->estatus = ($request['estatus'] == "on")?1:0;
                $message = "Registro Actualizado";
            }
            $product->save();
            
            if($request['id_product_redirect'] == 'true'){
                return redirect('/products')->with('success', $message);
            }else{
                return Supply::all();
            }
        }catch (QueryException $e){
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return redirect('/products')->with('error', $message);
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
            $product = Product::findOrFail($id);
            $product->delete();
            return redirect('/products')->with('success', 'Registro Borrado');        
        }catch (QueryException $e){
            $message = $e->errorInfo[1] ."-".$e->errorInfo[2];
            return redirect('/products')->with('error', $message);
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
            $product = Product::where($request['column'], 'like', $request['val'])
            ->where('id_product', '!=', $request['id'])->get();
        }else{
            $product = Product::where($request['column'], 'like', $request['val'])->get();
        }

        return $product;
    }
}
