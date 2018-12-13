<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProviderCategory extends Model
{
    /**
    *The name de primarykey if is diferente of the id
    *
    *
    */
    protected $primaryKey = 'id_provider_category';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'clave', 'description', 'estatus',
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