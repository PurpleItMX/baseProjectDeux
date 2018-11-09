<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    /**
    *The name de primarykey if is diferente of the id
    *
    *
    */
    protected $primaryKey = 'id_season';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'clave', 'time_initial', 'time_end', 'estatus',
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