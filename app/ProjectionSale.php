<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectionSale extends Model
{
	/**
    *The name de primarykey if is diferente of the id
    *
    *
    */
    protected $primaryKey = 'id_projection_sale';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'folio', 'date_initial', 'date_end', 'sale_sa', 'cost_sa', 'sale_proj', 'cost_proj', 'variation', 'estatus', 'autorization'
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

