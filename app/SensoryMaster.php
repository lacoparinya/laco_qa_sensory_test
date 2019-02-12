<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SensoryMaster extends Model
{
    protected $fillable = [
        'test_date',
        'test_time',
        'sensory_name',
        'note',
        'status'
    ];

    public function sensoryDetail()
    {
        return $this->hasMany('App\SensoryDetail', 'sensory_master_id');
    }
}
