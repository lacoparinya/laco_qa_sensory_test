<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestSuitD extends Model
{
    protected $fillable = ['test_suit_m_id','code','details','seq','ans'];

    public function testsuitm()
    {
        return $this->hasOne('App\TestSuitM', 'id', 'test_suit_m_id');
    }
}
