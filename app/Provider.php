<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{

	/**
    *The name de primarykey if is diferente of the id
    *
    *
    */
    protected $primaryKey = 'id_provider';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'clave', 'rfc', 'name', 'name_commercial', 'type', 'street', 'number_ext', 'number_int', 'colony', 'city', 'state', 'country', 'zip_code', 'phone', 'email', 'estatus', 'id_provider_category', 'id_provider_type'
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
