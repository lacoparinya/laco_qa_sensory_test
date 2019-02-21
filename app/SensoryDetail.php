<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SensoryDetail extends Model
{
    protected $fillable = [
        'sensory_master_id',
        'qa_sample_data_id',
        'seq',
        'code',
        'time',
        'note',
        'status'
    ];

    public function sensoryMaster()
    {
        return $this->hasOne('App\SensoryMaster', 'id', 'sensory_master_id');
    }

    public function qaSampleData()
    {
        return $this->hasOne('App\QaSampleSensory', 'id', 'qa_sample_data_id');
    }
}
