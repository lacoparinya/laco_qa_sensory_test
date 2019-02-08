<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SensoryTestM extends Model
{
    protected $fillable = [
        'sensory_master_id',
        'test_date',
        'tester_name',
        'tester_note',
        'note'
    ];

    public function sensoryMaster()
    {
        return $this->hasOne('App\SensoryMaster', 'id', 'sensory_master_id');
    }
}
