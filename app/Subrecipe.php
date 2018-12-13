<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subrecipe extends Model
{
     //protected $table = 'supplies_warehouses';

	/**
    *The name de primarykey if is diferente of the id
    *
    *
    */
    protected $primaryKey = 'id_subrecipe';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'clave', 'description', 'udm', 'unit_cost', 'performance', 'recipe_cost', 'previous_production_week', 'quantity_produce', 'estatus',
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
