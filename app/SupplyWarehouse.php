<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplyWarehouse extends Model
{

     protected $table = 'supplies_warehouses';

	/**
    *The name de primarykey if is diferente of the id
    *
    *
    */
    protected $primaryKey = 'id_supply_warehouse';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_warehouse', 'id_supply', 'percent', 
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