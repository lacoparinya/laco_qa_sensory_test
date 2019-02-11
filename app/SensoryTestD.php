<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SensoryTestD extends Model
{
    protected $fillable = [
        'sensory_test_ms_id'
        ,'sensory_detail_id'
        ,'qa_sample_data_id'
        ,'sample_code'
        ,'product_code'
        ,'color'
        ,'odor'
        ,'texture'
        ,'taste'
        ,'result'
        ,'status'
    ];

    public function sensoryTestM()
    {
        return $this->hasOne('App\SensoryTestM', 'id', 'sensory_test_ms_id');
    }

    public function sensoryDetail()
    {
        return $this->hasOne('App\SensoryDetail', 'id', 'sensory_detail_id');
    }

    public function qaSampleData()
    {
        return $this->hasOne('App\QaSampleData', 'id', 'qa_sample_data_id');
    }
}
