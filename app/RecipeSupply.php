<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecipeSupply extends Model
{
     protected $table = 'recipe_supplies';

	/**
    *The name de primarykey if is diferente of the id
    *
    *
    */
    protected $primaryKey = 'id_recipe_supply';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'id_recipe', 'id_supply', 'unity', 'cost', 'gr_recipe', 'performance', 'gr_neto', 'cost_supply', 'quantity_occupy', 'cost_total',
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
