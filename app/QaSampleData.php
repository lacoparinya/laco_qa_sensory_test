<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QaSampleData extends Model
{
    //
    protected $fillable = [
        'product_code',
        'storedate_shift',
        'seq_sample_code',
        'test_date',
        'sample_date',
        'sample_time',
        'product_name',
        'month', 
        'product_group',
        'broker_Code',
        'farmer_name',
        'produce_date',
        'sample_r_time',
        'box_number',
        'tpc_m', //-1 x =  < 
        'tpc_d',
        'code_x',
        'Dilution',
        'power',
        'colonies', //-1 = รอผล
        'coliform',
        'code_x2',
        'Dilution2',
        'power2',
        'colonies2', //-1 = รอผล
        'e_coli',
        'yeast',
        'mold',
        'salt_pod',
        'salt_kernel',
        'salt_percent',
        'ph_dark',
        'ph_light',
        'ph',
        'ph_kernel',
        'tss_dark',
        'tss_light',
        'tss',
        'tss_kernel',
        'ta_dark',
        'ta_light',
        'ta',
        'hardness',
        'viscosity',
        'pallet_code',
        'line',
        'hr',
        'status',
        'note',
    ];
}
