<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectionSaleDetail extends Model
{
    /**
    *The name de primarykey if is diferente of the id
    *
    *
    */
    protected $primaryKey = 'id_projection_sale_detail';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_projection_sale', 'id_supply', 'quantity_sold', 'quantity_proyec', 'price_sale', 'price_proyec', 'price_without_taxes', 'entry','entry_proyec', 'cost', 'cost_proyec', 'cost_percent_proyec', 'cost_total_proyec', 'expense_proyec', 'utility_proyec', 'utility_total_proyec'
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


 
