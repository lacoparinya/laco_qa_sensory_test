<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestSuitM extends Model
{
    protected $fillable = ['test_date', 'test_set','name','details','status'];

    public function testsuitd()
    {
        return $this->hasMany('App\TestSuitD', 'test_suit_m_id');
    }

    public function testsuitdorderseq()
    {
        return $this->testsuitd()->orderBy('seq');
    }

    public function anssuitm()
    {
        return $this->hasMany('App\AnsSuitM', 'test_suit_m_id');
    }
}
