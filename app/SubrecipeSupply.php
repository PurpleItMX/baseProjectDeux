<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubrecipeSupply extends Model
{
     protected $table = 'subrecipe_supplies';

	/**
    *The name de primarykey if is diferente of the id
    *
    *
    */
    protected $primaryKey = 'id_subrecipe_supply';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_subrecipe', 'id_supply','clave', 'description', 'unity', 'cost', 'gr_recipe', 'performance', 'gr_neto', 'cost_supply', 'quantity_occupy', 'production_required',
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
