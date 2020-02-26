<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnsSuitD extends Model
{
    protected $fillable = ['ans_suit_m_id', 'test_suit_d_id','value','comments','result'];

    public function anssuitm()
    {
        return $this->hasOne('App\AnsSuitM', 'id', 'ans_suit_m_id');
    }

    public function testsuitd()
    {
        return $this->hasOne('App\TestSuitD', 'id', 'test_suit_d_id');
    }
}
