<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
     //protected $table = 'supplies_warehouses';

	/**
    *The name de primarykey if is diferente of the id
    *
    *
    */
    protected $primaryKey = 'id_recipe';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'clave','description', 'udm', 'cost_sale', 'expenditure_operative', 'margen_actually', 'margen_category', 'price_sale', 'utility', 'iva', 'import_iva', 'price_sale_iva', 'quantity_sale', 'production_cost', 'quantity_sell', 'cost_projection', 'estatus',
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
