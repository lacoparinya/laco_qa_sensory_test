<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QaSampleSensory extends Model
{
    protected $fillable = [
    'run_number',
    'sampling_date',
    'sampling_no', 
    'product_name', 
    'customer_farmer',
    'order_no_loading_date',  
    'mfg_date',
    'exp_date',
    'lot_batch',  
    'product_details', 
    'carton_no', 
    'pallet_no'
    ];
}
