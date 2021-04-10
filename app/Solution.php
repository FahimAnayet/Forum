<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    protected $guarded = [];
	public function user()
	{
		return $this->belongsTo('App\User');
	}
	public function problem() //problem_id
	{
		return $this->belongsTo('App\Problem');
	}
}
