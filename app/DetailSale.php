<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailSale extends Model
{
 	/**
    *The name de primarykey if is diferente of the id
    *
    *
    */
    protected $primaryKey = 'id_detail_sales';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'week', 'month', 'year', 'week_day', 'week_number', 'month_name', 'day_number', 'season', 'company', 'region', 'zone', 'waiter', 'section_restaurant', 'command_type', 'time', 'time_grouper', 'id_product', 'dish', 'group_dish', 'group_menu', 'type_dish', 'ticket', 'modified', 'total_sale', 'discounts', 'gross_sales', 'taxes', 'taxes_discounts', 'taxes_gross', 'sales_net', 'cost_sales', 'unity_sales', 'back_sales',
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