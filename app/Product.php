<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
 	/**
    *The name de primarykey if is diferente of the id
    *
    *
    */
    protected $primaryKey = 'id_product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'clave', 'description', 'udm', 'id_product_type', 'id_product_category', 'price_sale', 'margen_category', 'margen_actually', 'cost_sale', 'expenditure_operative', 'utility', 'iva', 'import_iva', 'price_sale_iva', 'estatus',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];
}