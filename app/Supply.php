<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
	/**
    *The name de primarykey if is diferente of the id
    *
    *
    */
    protected $primaryKey = 'id_supply';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'clave', 'description', 'udm', 'id_supply_category', 'id_supply_type', 'id_season', 'tolerance', 'stock_fixed', 'stock_variable', 'minimal_presentation', 'is_inventorial', 'is_product', 'is_auditable', 'is_direct_purchase', 'type', 'estatus', 'id_provider_primary', 'id_provider_second', 'id_provider_third'
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
            