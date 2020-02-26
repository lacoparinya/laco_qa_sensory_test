<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnsSuitM extends Model
{
    protected $fillable = ['test_suit_m_id', 'name', 'comments', 'resultrate', 'resulttxt', 'status'];

    public function testsuitm()
    {
        return $this->hasOne('App\TestSuitM', 'id', 'test_suit_m_id');
    }

    public function anssuitd()
    {
        return $this->hasMany('App\AnsSuitD', 'ans_suit_m_id');
    }
}
